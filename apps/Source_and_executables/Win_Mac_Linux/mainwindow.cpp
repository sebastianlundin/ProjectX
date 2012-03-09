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

MainWindow::MainWindow(QWidget *parent) : QMainWindow(parent), ui(new Ui::MainWindow)
{
    ui->setupUi(this);

    this->apiFuncs = new ApiFuncs();
    this->jsonFuncs = new JsonFuncs();
    this->cacheFuncs = new CacheFuncs();
    this->settingsFuncs = new SettingsFuncs();
    this->fileFuncs = new FileFuncs();
    this->animationTimer = new QTimer(this);
    this->keyboardShortcuts = new QxtGlobalShortcut(this);

    QStringList snippetListHeaders;
    snippetListHeaders << "Languages" << "Language id" << "Title" << "Id"
                       << "Description" << "By user" << "Added/Changed" << "Rating";
    ui->listSnippets->setHeaderLabels(snippetListHeaders);

    this->ShowPossiblyErrorAboutConnection();

    ui->foundNumberOfSnippets->setHidden(true);
    connect(this->keyboardShortcuts, SIGNAL(activated()), this, SLOT(ShowWindowAndFocusSearchField()));
    connect(ui->searchField, SIGNAL(returnPressed()), this, SLOT(SearchSnippet()));
    this->KeyboardActions();

    for(int i = 0; i < 8; i++)
    {
        ui->listSnippets->resizeColumnToContents(i);
    }
    ui->listSnippets->setSortingEnabled(true);

    this->ListSearchFiles();

    connect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
    connect(ui->previousSearchesList, SIGNAL(currentIndexChanged(int)), this, SLOT(FillListWithPrevSearches(int)));
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

void MainWindow::SearchSnippet()
{
    ui->listSnippets->clear();
    ui->selectedSnippet->clear();

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
        else
        {
            this->animationTimer->stop();
            ui->searchLabel->setText("Search for a snippet (use for example: word + word or just search for one single word):");
            ui->foundNumberOfSnippets->setHidden(false);
            ui->foundNumberOfSnippets->setText("0 snippets found!");
            QMessageBox::warning(this, "No snippets found", "Couldn't find any snippets that matches with your search.\n\nTry again!");
        }
    }
    else
    {
        QMessageBox::warning(this, "Empty field!", "You can't search for nothing. \n\n(hint: empty field)\n\nTry again!");
    }
}

void MainWindow::FillListWithSnippets(QVariantList a_jsonObject)
{
    foreach(QVariant record, a_jsonObject)
    {
        QVariantMap map = record.toMap();
        QString language = map.value("language").toString();
        QString languageid = map.value("languageid").toString();
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
        }
        else
        {
            group = items.at(0);
        }

        QTreeWidgetItem *child = new QTreeWidgetItem(this->group);
        child->setText(1, languageid);
        child->setText(2, title);
        child->setText(3, id);
        child->setText(4, description);
        child->setText(5, username);
        child->setText(6, date);
        child->setText(37, rating);
    }
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
            ui->previousSearchesList->addItem(this->fileFuncs->GetSearchString(listFilesFromCacheDirectory.fileName()),
                                              listFilesFromCacheDirectory.fileName());
        }
    }
}

MainWindow::~MainWindow()
{
    disconnect(this->keyboardShortcuts, SIGNAL(activated()), this, SLOT(ShowWindowAndFocusSearchField()));
    disconnect(ui->searchField, SIGNAL(returnPressed()), this, SLOT(SearchSnippet()));
    disconnect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
    disconnect(ui->previousSearchesList, SIGNAL(currentIndexChanged(int)), this, SLOT(FillListWithPrevSearches(int)));
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
    SettingsDialog *settingsDialog = new SettingsDialog();
    settingsDialog->show();
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
        this->keyboardShortcuts->setShortcut(QKeySequence(activeShortcutConv));
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
    QString cacheSelectedSnippetFilename = a_item->text(3);
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

void MainWindow::FillListWithPrevSearches(int a_index)
{
    QString itemSearchString = ui->previousSearchesList->itemText(a_index).toUtf8();
    QString itemSearchFile = ui->previousSearchesList->itemData(a_index).toString();

    ui->listSnippets->clear();
    ui->searchField->clear();

    QVariantList jsonData = this->jsonFuncs->GetJsonObject
    (
        this->cacheFuncs->GetCacheFileData(itemSearchFile)
    );

    if (jsonData.count() > 0)
    {
        this->FillListWithSnippets
        (
            this->jsonFuncs->GetJsonObject
            (
                this->cacheFuncs->GetCacheFileData(itemSearchFile)
            )
        );
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

void MainWindow::on_copySnippet_clicked()
{
    QClipboard *clipboard = QApplication::clipboard();
    clipboard->setText(ui->selectedSnippet->toPlainText());
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
        this->ListSearchFiles();
        ui->deleteSelectedPrevSearch->setEnabled(false);
        QMessageBox::information(this, "File has been deleted!", "The file with item of "  + itemSearchString + " has been deleted!");
    }
}
