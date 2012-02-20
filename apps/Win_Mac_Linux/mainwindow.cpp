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

MainWindow::MainWindow(QWidget *parent) : QMainWindow(parent), ui(new Ui::MainWindow)
{
    ui->setupUi(this);

    this->apiFuncs = new ApiFuncs();
    this->jsonFuncs = new JsonFuncs();
    this->cacheFuncs = new CacheFuncs();

    QStringList snippetListHeaders;
    snippetListHeaders << "Languages" << "Language id" << "Title" << "Id"
                       << "Description" << "By user" << "Added/Changed" << "Rating";
    ui->listSnippets->setHeaderLabels(snippetListHeaders);

    this->Initialize();
}

void MainWindow::Initialize()
{
    ApiFuncs *apiFuncs = new ApiFuncs();
    JsonFuncs *jsonFuncs = new JsonFuncs();
    CacheFuncs *cacheFuncs = new CacheFuncs();
    QString cacheListAllSnippetsFilename = "list_all_snippets";

    apiFuncs->ConnectToApi(cacheListAllSnippetsFilename, "http://tmpn.se/api/snippets");
    this->FillListWithSnippets(jsonFuncs->GetJsonObject(cacheFuncs->GetCacheFileData(cacheListAllSnippetsFilename)));
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

    connect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
}

MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::on_aboutSnippt_triggered()
{
    QMessageBox::about(this, "About Snippt", "Snippt is a platform for sharing snippets of code thru "
                       "an API and some client-applications for the web etc.\n\n"
                       "This is the client for Windows/Mac OS X/Linux");
}

void MainWindow::ShowSelectedSnippet(QTreeWidgetItem *a_item, int a_column)
{
    QString cacheSelectedSnippetFilename = a_item->text(3);
    this->apiFuncs->ConnectToApi(cacheSelectedSnippetFilename, "http://tmpn.se/api/snippets?id=" + cacheSelectedSnippetFilename);

    QByteArray jsonCacheData = this->cacheFuncs->GetCacheFileData(cacheSelectedSnippetFilename);
    QVariantList jsonObject = this->jsonFuncs->GetJsonObject(jsonCacheData);
    QString  snippetCode = this->jsonFuncs->GetSnippetCode(jsonObject);

    if (cacheSelectedSnippetFilename != 0)
    {
        ui->copySnippet->setEnabled(true);
    }
    else
    {
        ui->copySnippet->setEnabled(false);
    }

    ui->selectedSnippet->setText(snippetCode);

    //disconnect(ui->listSnippets, SIGNAL(itemClicked(QTreeWidgetItem*,int)), this, SLOT(ShowSelectedSnippet(QTreeWidgetItem*,int)));
}

//void MainWindow::on_pushButton_clicked()
//{
/*QTreeWidgetItemIterator it(ui->treeWidget);
    while (*it)
    {
        if ((*it)->text(1) == ui->lineEdit->text())
        {
            (*it)->setSelected(true);
            ui->treeWidget->scrollToItem(*it);
        }
        ++it;
    }*/

/* ui->lineEdit->clear();

    QList<QTreeWidgetItem*> items = ui->treeWidget->findItems(ui->lineEdit->text(), Qt::MatchContains, 0);

    if(items.count())
    {
        items.first()->setSelected(true);
        ui->treeWidget->scrollToItem(items.first());
    }*/
//}

void MainWindow::on_copySnippet_clicked()
{
    QClipboard *clipboard = QApplication::clipboard();
    clipboard->setText(ui->selectedSnippet->toPlainText());
}
