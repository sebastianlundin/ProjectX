/********************************************************************************
** Form generated from reading UI file 'mainwindow.ui'
**
** Created: Mon Feb 20 00:34:10 2012
**      by: Qt User Interface Compiler version 4.8.0
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_MAINWINDOW_H
#define UI_MAINWINDOW_H

#include <QtCore/QVariant>
#include <QtGui/QAction>
#include <QtGui/QApplication>
#include <QtGui/QButtonGroup>
#include <QtGui/QComboBox>
#include <QtGui/QGridLayout>
#include <QtGui/QHeaderView>
#include <QtGui/QLabel>
#include <QtGui/QLineEdit>
#include <QtGui/QMainWindow>
#include <QtGui/QMenu>
#include <QtGui/QMenuBar>
#include <QtGui/QPushButton>
#include <QtGui/QTextEdit>
#include <QtGui/QTreeWidget>
#include <QtGui/QWidget>

QT_BEGIN_NAMESPACE

class Ui_MainWindow
{
public:
    QAction *aboutSnippt;
    QWidget *guiGrid;
    QGridLayout *gridLayout;
    QLineEdit *searchField;
    QPushButton *searchSnippet;
    QLabel *previousSearchesLabel;
    QComboBox *comboBox;
    QLabel *listSnippetsLabel;
    QTreeWidget *listSnippets;
    QLabel *selectedSnippetLabel;
    QTextEdit *selectedSnippet;
    QPushButton *copySnippet;
    QPushButton *deleteSelectedPrevSearch;
    QMenuBar *menubar;
    QMenu *menuHelp;

    void setupUi(QMainWindow *MainWindow)
    {
        if (MainWindow->objectName().isEmpty())
            MainWindow->setObjectName(QString::fromUtf8("MainWindow"));
        MainWindow->resize(909, 537);
        aboutSnippt = new QAction(MainWindow);
        aboutSnippt->setObjectName(QString::fromUtf8("aboutSnippt"));
        guiGrid = new QWidget(MainWindow);
        guiGrid->setObjectName(QString::fromUtf8("guiGrid"));
        gridLayout = new QGridLayout(guiGrid);
        gridLayout->setObjectName(QString::fromUtf8("gridLayout"));
        searchField = new QLineEdit(guiGrid);
        searchField->setObjectName(QString::fromUtf8("searchField"));

        gridLayout->addWidget(searchField, 0, 0, 2, 1);

        searchSnippet = new QPushButton(guiGrid);
        searchSnippet->setObjectName(QString::fromUtf8("searchSnippet"));

        gridLayout->addWidget(searchSnippet, 0, 1, 2, 1);

        previousSearchesLabel = new QLabel(guiGrid);
        previousSearchesLabel->setObjectName(QString::fromUtf8("previousSearchesLabel"));

        gridLayout->addWidget(previousSearchesLabel, 2, 0, 1, 2);

        comboBox = new QComboBox(guiGrid);
        comboBox->setObjectName(QString::fromUtf8("comboBox"));

        gridLayout->addWidget(comboBox, 4, 0, 1, 1);

        listSnippetsLabel = new QLabel(guiGrid);
        listSnippetsLabel->setObjectName(QString::fromUtf8("listSnippetsLabel"));

        gridLayout->addWidget(listSnippetsLabel, 6, 0, 1, 1);

        listSnippets = new QTreeWidget(guiGrid);
        QTreeWidgetItem *__qtreewidgetitem = new QTreeWidgetItem();
        __qtreewidgetitem->setText(0, QString::fromUtf8("1"));
        listSnippets->setHeaderItem(__qtreewidgetitem);
        listSnippets->setObjectName(QString::fromUtf8("listSnippets"));
        listSnippets->setAlternatingRowColors(true);
        listSnippets->setSelectionMode(QAbstractItemView::SingleSelection);
        listSnippets->setSortingEnabled(true);
        listSnippets->setAnimated(true);
        listSnippets->header()->setCascadingSectionResizes(true);
        listSnippets->header()->setHighlightSections(false);

        gridLayout->addWidget(listSnippets, 7, 0, 1, 2);

        selectedSnippetLabel = new QLabel(guiGrid);
        selectedSnippetLabel->setObjectName(QString::fromUtf8("selectedSnippetLabel"));

        gridLayout->addWidget(selectedSnippetLabel, 8, 0, 1, 1);

        selectedSnippet = new QTextEdit(guiGrid);
        selectedSnippet->setObjectName(QString::fromUtf8("selectedSnippet"));
        selectedSnippet->setAcceptDrops(false);
        selectedSnippet->setFrameShape(QFrame::StyledPanel);
        selectedSnippet->setFrameShadow(QFrame::Sunken);
        selectedSnippet->setUndoRedoEnabled(false);
        selectedSnippet->setReadOnly(true);

        gridLayout->addWidget(selectedSnippet, 9, 0, 1, 2);

        copySnippet = new QPushButton(guiGrid);
        copySnippet->setObjectName(QString::fromUtf8("copySnippet"));
        copySnippet->setEnabled(false);
        copySnippet->setAutoDefault(false);
        copySnippet->setDefault(false);
        copySnippet->setFlat(false);

        gridLayout->addWidget(copySnippet, 10, 0, 1, 2);

        deleteSelectedPrevSearch = new QPushButton(guiGrid);
        deleteSelectedPrevSearch->setObjectName(QString::fromUtf8("deleteSelectedPrevSearch"));
        deleteSelectedPrevSearch->setEnabled(false);

        gridLayout->addWidget(deleteSelectedPrevSearch, 4, 1, 1, 1);

        MainWindow->setCentralWidget(guiGrid);
        menubar = new QMenuBar(MainWindow);
        menubar->setObjectName(QString::fromUtf8("menubar"));
        menubar->setGeometry(QRect(0, 0, 909, 22));
        menuHelp = new QMenu(menubar);
        menuHelp->setObjectName(QString::fromUtf8("menuHelp"));
        MainWindow->setMenuBar(menubar);

        menubar->addAction(menuHelp->menuAction());
        menuHelp->addAction(aboutSnippt);

        retranslateUi(MainWindow);

        QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
        MainWindow->setWindowTitle(QString());
        aboutSnippt->setText(QApplication::translate("MainWindow", "About Snippt", 0, QApplication::UnicodeUTF8));
        searchSnippet->setText(QApplication::translate("MainWindow", "Search", 0, QApplication::UnicodeUTF8));
        previousSearchesLabel->setText(QApplication::translate("MainWindow", "Previous searches:", 0, QApplication::UnicodeUTF8));
        listSnippetsLabel->setText(QApplication::translate("MainWindow", "Snippets:", 0, QApplication::UnicodeUTF8));
        selectedSnippetLabel->setText(QApplication::translate("MainWindow", "Selected snippet:", 0, QApplication::UnicodeUTF8));
        copySnippet->setText(QApplication::translate("MainWindow", "Copy snippet", 0, QApplication::UnicodeUTF8));
        deleteSelectedPrevSearch->setText(QApplication::translate("MainWindow", "Delete", 0, QApplication::UnicodeUTF8));
        menuHelp->setTitle(QApplication::translate("MainWindow", "Help", 0, QApplication::UnicodeUTF8));
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_MAINWINDOW_H
