// Class for working with the main user interface (where you can search snippets etc)

// Includes all the importen libs (in qt)
// that we need to use for this class to work
#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QMessageBox>
#include "jsonfuncs.h"
#include <QVariantList>
#include <QMessageBox>
#include <QList>
#include <QDir>
#include <QClipboard>
#include "apifuncs.h"
#include "cachefuncs.h"
#include <libs/code/libqxt/qxtapplication.h>
#include <libs/code/libqxt/qxtglobalshortcut.h>
#include <QTimer>
#include <QSettings>
#include <QDirIterator>
#include "customcombobox.h"
#include <QDesktopWidget>

// Move the window to the center of the screen
void MainWindow::CenterWindow()
{
    QRect windowGeometry = frameGeometry();
    windowGeometry.moveCenter(QDesktopWidget().availableGeometry().center());
}

// Constructor
MainWindow::MainWindow(QWidget *parent) : QMainWindow(parent), ui(new Ui::MainWindow)
{
    ui->setupUi(this); // Pointer to the interface-file (mainwindow.ui)

    this->CenterWindow();

    this->apiFuncs = new ApiFuncs(); // Instance of the ApiFuncs-class
    this->jsonFuncs = new JsonFuncs(); // Instance of the JsonFuncs-class
    this->cacheFuncs = new CacheFuncs(); // Instance of the CacheFuncs-class
    this->settingsFuncs = new SettingsFuncs(); // Instance of the SettingsFuncs-class
    this->fileFuncs = new FileFuncs(); // Instance of the FileFuncs-class
    this->animationTimer = new QTimer(this); // Instance of the QTimer-class
    this->keyboardShortcutActiveKey = new QxtGlobalShortcut(this); // Instance of the QxtGlobalShortcut-class
    this->keyboardShortcutCopyKey = new QxtGlobalShortcut(this); // Instance of the QxtGlobalShortcut-class
    this->settingsDialog = new SettingsDialog(); // Instance of the SettingsDialog-class

    // Set the headers for the treeview, who holds the snippets and its categories
    QStringList snippetListHeaders;
    snippetListHeaders << "Languages" << "Title" << "Description" << "By user" << "Added/Changed" << "Rating";
    ui->listSnippets->setHeaderLabels(snippetListHeaders);

    // Test the connection to the api (thru another method in another class), and show a possible if its an error with it
    this->ShowPossiblyErrorAboutConnection();

    ui->foundNumberOfSnippets->setHidden(true);
    connect(this->keyboardShortcutActiveKey, SIGNAL(activated()), this, SLOT(ShowWindowAndFocusSearchField()));
    connect(this->keyboardShortcutCopyKey, SIGNAL(activated()), this, SLOT(CopySelectedSnippet()));
    connect(ui->searchField, SIGNAL(returnPressed()), this, SLOT(SearchSnippet()));
    this->KeyboardActions();

    ui->listSnippets->setSortingEnabled(true);

    this->ListSearchFiles();

    connect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
    connect(ui->previousSearchesList, SIGNAL(currentIndexChanged(int)), this, SLOT(FillListWithPrevSearches(int)));
    connect(this->settingsDialog, SIGNAL(UpdateKeyboardSettings()), this, SLOT(KeyboardActions()));
    this->installEventFilter(this);

    this->ShowAndHideElementsWithNewSearch();
}

void MainWindow::ShowPossiblyErrorAboutConnection()
{
    bool testConnection = true;
    QString apiUrl = this->settingsFuncs->GetApiUrl();

    apiFuncs->ConnectToApi("nofile", apiUrl, testConnection, "");

    if (testConnection == false)
    {
        QMessageBox::information(this, "Can't connect!", "Can't connect to the API!\nAdd the right URL under Preferences"
                                 " in the Help/Application menu!\n\nIf its not working directly - try to restart the app a few times!");
    }
}

void MainWindow::ShowAllElements()
{
    this->CenterWindow();

    ui->searchLabel->show();
    ui->searchSnippet->show();
    ui->previousSearchesLabel->show();
    ui->previousSearchesList->show();
    ui->deleteSelectedPrevSearch->show();

    ui->listSnippetsLabel->show();
    ui->listSnippets->show();
    ui->foundNumberOfSnippets->show();
    ui->selectedSnippetLabel->show();
    ui->selectedSnippet->show();
    ui->copySnippet->show();

    this->setMinimumHeight(470);
    this->resize(909, 470);
    this->CenterWindow();
    this->setSizePolicy(QSizePolicy::Minimum, QSizePolicy::Minimum);
    this->setWindowFlags(Qt::Window | Qt::WindowTitleHint | Qt::WindowCloseButtonHint | Qt::WindowMinMaxButtonsHint | Qt::CustomizeWindowHint);
    this->show();
}

void MainWindow::ShowAndHideElementsWithNewSearch()
{
    this->CenterWindow();

    ui->previousSearchesList->setCurrentIndex(0);

    ui->searchLabel->show();
    ui->searchSnippet->show();
    ui->previousSearchesLabel->show();
    ui->previousSearchesList->show();
    ui->deleteSelectedPrevSearch->show();

    ui->listSnippets->clear();
    ui->selectedSnippet->clear();

    ui->listSnippetsLabel->hide();
    ui->listSnippets->hide();
    ui->foundNumberOfSnippets->hide();
    ui->selectedSnippetLabel->hide();
    ui->selectedSnippet->hide();
    ui->copySnippet->hide();

    this->setMinimumHeight(160);
    this->resize(1, 1);
    this->setSizePolicy(QSizePolicy::Fixed, QSizePolicy::Fixed);
    this->setWindowFlags(Qt::Window | Qt::WindowTitleHint | Qt::WindowCloseButtonHint | Qt::WindowMinimizeButtonHint | Qt::CustomizeWindowHint);
    this->show();
}

bool MainWindow::eventFilter(QObject *a_object, QEvent *a_event)
{
    if(a_event->type() == QEvent::WindowStateChange && isMinimized())
    {
        this->ShowAndHideElementsWithNewSearch();
    }
    return true;
}

void MainWindow::SearchSnippet()
{
    ui->listSnippets->clear();
    ui->selectedSnippet->clear();

    if (ui->previousSearchesList->findText(ui->searchField->text().trimmed()) == -1)
    {
        if (ui->searchField->text().count() != 0)
        {
            connect(this->animationTimer, SIGNAL(timeout()), this, SLOT(UpdateSearchAnimation()));
            ui->searchLabel->setText("Searching");
            animationTimer->start(500);

            this->ShowPossiblyErrorAboutConnection();
            bool testConn = true;

            QString apiUrl = settingsFuncs->GetApiUrl().toUtf8();
            QString theDateAndTime = this->fileFuncs->GetUnixTime(0).toUtf8();

            apiFuncs->ConnectToApi("search" + theDateAndTime + ".search", apiUrl + "/search/" + ui->searchField->text(), testConn, ui->searchField->text());

            QVariantList jsonData = this->jsonFuncs->GetJsonObject
            (
                cacheFuncs->GetCacheFileData("search" + theDateAndTime + ".search")
            );

            if (jsonData.count() > 0)
            {
                this->ShowAllElements();

                this->FillListWithSnippets
                (
                    jsonFuncs->GetJsonObject
                    (
                        cacheFuncs->GetCacheFileData("search" + theDateAndTime + ".search")
                    )
                );

                ui->foundNumberOfSnippets->setHidden(false);
                QString snippetNumber;
                snippetNumber.setNum(jsonData.count());
                ui->foundNumberOfSnippets->setText(snippetNumber.toUtf8() + " snippets found!");
                ui->listSnippets->setFocus();
                QTreeWidgetItemIterator item (ui->listSnippets);
                ui->listSnippets->setCurrentItem(*item);
                ui->listSnippets->expandAll();
                ui->previousSearchesList->clear();
                this->ListSearchFiles();
            }
            else if (jsonData.count() <= 0)
            {
                this->animationTimer->stop();
                ui->searchLabel->setText("Search for a snippet (use for example: word + word or just search for one single word):");
                ui->foundNumberOfSnippets->setHidden(false);
                ui->foundNumberOfSnippets->setText("0 snippets found!");
                QMessageBox::warning(this, "No snippets found", "Couldn't find any snippets that matches with your search.\n\nTry again!");
                ui->previousSearchesList->setCurrentIndex(0);
                ui->searchField->clear();
                this->ShowAndHideElementsWithNewSearch();
            }
            else if (!jsonData.startsWith("["))
            {
                this->animationTimer->stop();
                ui->searchLabel->setText("Search for a snippet (use for example: word + word or just search for one single word):");
                ui->foundNumberOfSnippets->setHidden(true);
                QMessageBox::warning(this, "Api errors!", "Seems to be some errors with the API!\n\nTry again later or switch to another API-URL in settings!\n\nAnd try again!");
                ui->searchField->clear();
                ui->searchField->setFocus();
            }
        }
    }
    else if (ui->searchField->text().count() == 0)
    {
        QMessageBox::warning(this, "Empty field!", "You can't search for nothing. \n\n(hint: empty field)\n\nTry again!");
    }
    else
    {
        QMessageBox::warning(this, "There is an old searchitem!", "There is already a searchitem with that searchstring in the old searches!\n\nUse that one, or try again!");
        ui->searchField->clear();
        ui->previousSearchesList->setFocus();
        ui->foundNumberOfSnippets->setText("");
    }
}

void MainWindow::FillListWithSnippets(QVariantList a_jsonObject)
{
    foreach(QVariant record, a_jsonObject)
    {
        QVariantMap map = record.toMap();
        QString language = map.value("language").toString();
        QString title = map.value("title").toString();
        QString id = map.value("id").toString();
        QString description = map.value("description").toString();
        QString username = map.value("username").toString();
        QString date = map.value("date").toString();
        QString rating = map.value("rating").toString();

        QList<QTreeWidgetItem*> items = ui->listSnippets->findItems(language, Qt::MatchExactly, 0);

        if (items.count() == 0)
        {
            this->group = new QTreeWidgetItem(ui->listSnippets);
            this->group->setText(0, language);
            this->group->setText(1, title);
            this->group->setText(2, description);
            this->group->setText(3, username);
            this->group->setText(4, date);
            this->group->setText(5, rating);
        }
        else
        {
            group = items.at(0);
        }

        QTreeWidgetItem *child = new QTreeWidgetItem(this->group);
        child->setText(1, title);
        child->setText(2, description);
        child->setText(3, username);
        child->setText(4, date);
        child->setText(5, rating);
        QVariant idData(id);
        child->setData(1, Qt::UserRole,idData);
    }

    for(int i = 0; i < 6; i++)
    {
        ui->listSnippets->resizeColumnToContents(i);
    }
    ui->listSnippets->setColumnWidth(2, 150);
}

void MainWindow::ListSearchFiles()
{
    ui->previousSearchesList->addItem("", "");

    QDirIterator listFilesFromCacheDirectory(this->fileFuncs->GetUserDir(), QDir::Files);

    while (listFilesFromCacheDirectory.hasNext())
    {
        listFilesFromCacheDirectory.next();

        if (listFilesFromCacheDirectory.fileInfo().completeSuffix() == "search")
        {
            ui->previousSearchesList->addItem(this->fileFuncs->GetSearchString(listFilesFromCacheDirectory.fileName()).trimmed(),
                                              listFilesFromCacheDirectory.fileName());
        }
    }
}

MainWindow::~MainWindow()
{
    disconnect(this->keyboardShortcutActiveKey, SIGNAL(activated()), this, SLOT(ShowWindowAndFocusSearchField()));
    disconnect(this->keyboardShortcutCopyKey, SIGNAL(activated()), this, SLOT(CopySelectedSnippet()));
    disconnect(ui->searchField, SIGNAL(returnPressed()), this, SLOT(SearchSnippet()));
    disconnect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
    disconnect(ui->previousSearchesList, SIGNAL(currentIndexChanged(int)), this, SLOT(FillListWithPrevSearches(int)));
    delete this->apiFuncs;
    delete this->jsonFuncs;
    delete this->cacheFuncs;
    delete this->settingsFuncs;
    delete this->fileFuncs;
    delete this->animationTimer;
    delete this->keyboardShortcutActiveKey;
    delete this->keyboardShortcutCopyKey;
    delete this->settingsDialog;
    delete ui;
}

void MainWindow::on_aboutSnippt_triggered()
{
    QMessageBox::about(this, "About Snippt", "Snippt is a platform for searching snippets of code thru "
                       "an API and some client-applications for the web etc.\n\n"
                       "This is the client for Windows/Mac OS X/Linux");
}

void MainWindow::on_actionPreferences_triggered()
{
    this->settingsDialog->show();
}

void MainWindow::KeyboardActions()
{
    QVariant activeGlobalShortcuts, activeShortcut;

    QSettings settings("ProjectX", "Snippt");
    settings.beginGroup("SnipptSettings");

    activeGlobalShortcuts = settings.value("activeglobalshortcuts");
    QString activeGlobalShortcutsConv = activeGlobalShortcuts.toString();

    activeShortcut = settings.value("activeshortcut");
    QString activeShortcutConv = activeShortcut.toString();

    if (activeGlobalShortcutsConv == "activated")
    {
        this->keyboardShortcutActiveKey->setEnabled(true);
        this->keyboardShortcutCopyKey->setEnabled(true);

        this->keyboardShortcutActiveKey->setShortcut(QKeySequence(activeShortcutConv));
        this->keyboardShortcutCopyKey->setShortcut(QKeySequence("ctrl+alt+c"));
    }
    else
    {
        this->keyboardShortcutActiveKey->setDisabled(true);
        this->keyboardShortcutCopyKey->setDisabled(true);
    }

    settings.endGroup();
}

void MainWindow::ShowWindowAndFocusSearchField()
{
    this->showNormal();
    this->raise();
    this->activateWindow();
    ui->searchField->setFocus();
    ui->searchField->setText("");
    this->ShowAndHideElementsWithNewSearch();
}

void MainWindow::UpdateSearchAnimation()
{
    QString oldText = ui->searchLabel->text();
    ui->searchLabel->setText(oldText + ".");

    bool snippets = ui->listSnippets->topLevelItemCount();

    if (snippets > 0)
    {
        this->animationTimer->stop();
        ui->searchLabel->setText("Search for a snippet (use for example: word + word or just search for one single word):");
    }
}

void MainWindow::ShowSelectedSnippet(QTreeWidgetItem *a_item, int a_column)
{
    QString cacheSelectedSnippetFilename = a_item->data(1, Qt::UserRole).toString();

    QVariant apiUrl;
    bool testConn = true;
    QSettings settings("ProjectX", "Snippt");

    settings.beginGroup("SnipptSettings");

    apiUrl = settings.value("apiurl");
    QString apiUrlConv = apiUrl.toString();

    this->apiFuncs->ConnectToApi(cacheSelectedSnippetFilename, apiUrlConv.toUtf8() + "/search/" + cacheSelectedSnippetFilename, testConn, "");

    settings.endGroup();

    QByteArray jsonCacheData = this->cacheFuncs->GetCacheFileData(cacheSelectedSnippetFilename);
    QVariantList jsonObject = this->jsonFuncs->GetJsonObject(jsonCacheData);
    QString snippetCode = this->jsonFuncs->GetSnippetCode(jsonObject);

    if (cacheSelectedSnippetFilename != 0)
    {
        ui->copySnippet->setEnabled(true);
    }
    else
    {
        ui->copySnippet->setEnabled(false);
    }

    ui->selectedSnippet->setText(snippetCode);
}

void MainWindow::ClearFields()
{
    ui->searchField->clear();
    ui->selectedSnippet->clear();
    ui->copySnippet->setEnabled(false);
}

void MainWindow::FillListWithPrevSearches(int a_index)
{
    this->ClearFields();
    this->ShowAllElements();

    QString itemSearchString = ui->previousSearchesList->itemText(a_index).toUtf8();
    QString itemSearchFile = ui->previousSearchesList->itemData(a_index).toString();

    QVariantList jsonData = this->jsonFuncs->GetJsonObject
    (
        this->cacheFuncs->GetCacheFileData(itemSearchFile)
    );

    if (jsonData.count() > 0)
    {
        ui->listSnippets->clear();
        this->FillListWithSnippets
        (
            this->jsonFuncs->GetJsonObject
            (
                this->cacheFuncs->GetCacheFileData(itemSearchFile)
            )
        );
        ui->listSnippets->setFocus();
        QTreeWidgetItemIterator item (ui->listSnippets);
        ui->listSnippets->setCurrentItem(*item);
        ui->listSnippets->expandAll();
        QString snippetNumber;
        snippetNumber.setNum(jsonData.count());
        ui->foundNumberOfSnippets->setText(snippetNumber.toUtf8() + " snippets found!");
    }

    if (!itemSearchString.isEmpty())
    {
        ui->deleteSelectedPrevSearch->setEnabled(true);
    }
    else
    {
        ui->deleteSelectedPrevSearch->setEnabled(false);
    }
}

void MainWindow::CopySelectedSnippet()
{
    QClipboard *clipboard = QApplication::clipboard();
    clipboard->setText(ui->selectedSnippet->toPlainText());
}

void MainWindow::on_copySnippet_clicked()
{
    this->CopySelectedSnippet();
}

void MainWindow::on_searchSnippet_clicked()
{
    this->SearchSnippet();
}

void MainWindow::on_deleteSelectedPrevSearch_clicked()
{
    int selectedItemIndex = ui->previousSearchesList->currentIndex();
    QString itemSearchString = ui->previousSearchesList->itemText(selectedItemIndex).toUtf8();
    QString itemSearchFile = ui->previousSearchesList->itemData(selectedItemIndex).toString();

    if (this->fileFuncs->DeleteFile(itemSearchFile))
    {
        ui->previousSearchesList->removeItem(selectedItemIndex);
        ui->previousSearchesList->setCurrentIndex(0);
        ui->deleteSelectedPrevSearch->setEnabled(false);
        ui->listSnippets->clear();
        ui->selectedSnippet->clear();
        ui->foundNumberOfSnippets->setText("");
        ui->foundNumberOfSnippets->setHidden(true);

        if (ui->previousSearchesList->count() == 1)
        {
            this->ShowAndHideElementsWithNewSearch();
        }
    }
}
