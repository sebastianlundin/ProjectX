/********************************************************************************
** Form generated from reading UI file 'mainwindow.ui'
**
** Created: Fri Mar 9 16:28:10 2012
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
#include <QtGui/QGridLayout>
#include <QtGui/QHeaderView>
#include <QtGui/QLabel>
#include <QtGui/QLineEdit>
#include <QtGui/QMainWindow>
#include <QtGui/QMenu>
#include <QtGui/QMenuBar>
#include <QtGui/QPushButton>
#include <QtGui/QTextEdit>
#include <QtGui/QWidget>
#include "customcombobox.h"
#include "customtreewidget.h"

QT_BEGIN_NAMESPACE

class Ui_MainWindow
{
public:
    QAction *aboutSnippt;
    QAction *actionPreferences;
    QWidget *guiGrid;
    QGridLayout *gridLayout;
    QLineEdit *searchField;
    QPushButton *searchSnippet;
    QLabel *previousSearchesLabel;
    CustomComboBox *previousSearchesList;
    QLabel *listSnippetsLabel;
    CustomTreeWidget *listSnippets;
    QLabel *selectedSnippetLabel;
    QTextEdit *selectedSnippet;
    QPushButton *copySnippet;
    QPushButton *deleteSelectedPrevSearch;
    QLabel *searchLabel;
    QLabel *foundNumberOfSnippets;
    QMenuBar *menubar;
    QMenu *menuHelp;

    void setupUi(QMainWindow *MainWindow)
    {
        if (MainWindow->objectName().isEmpty())
            MainWindow->setObjectName(QString::fromUtf8("MainWindow"));
        MainWindow->resize(909, 470);
        QSizePolicy sizePolicy(QSizePolicy::Minimum, QSizePolicy::Fixed);
        sizePolicy.setHorizontalStretch(0);
        sizePolicy.setVerticalStretch(0);
        sizePolicy.setHeightForWidth(MainWindow->sizePolicy().hasHeightForWidth());
        MainWindow->setSizePolicy(sizePolicy);
        MainWindow->setMinimumSize(QSize(909, 160));
        QFont font;
        font.setPointSize(11);
        MainWindow->setFont(font);
        MainWindow->setContextMenuPolicy(Qt::DefaultContextMenu);
        MainWindow->setAcceptDrops(false);
        aboutSnippt = new QAction(MainWindow);
        aboutSnippt->setObjectName(QString::fromUtf8("aboutSnippt"));
        actionPreferences = new QAction(MainWindow);
        actionPreferences->setObjectName(QString::fromUtf8("actionPreferences"));
        guiGrid = new QWidget(MainWindow);
        guiGrid->setObjectName(QString::fromUtf8("guiGrid"));
        gridLayout = new QGridLayout(guiGrid);
        gridLayout->setObjectName(QString::fromUtf8("gridLayout"));
        searchField = new QLineEdit(guiGrid);
        searchField->setObjectName(QString::fromUtf8("searchField"));

        gridLayout->addWidget(searchField, 1, 0, 2, 1);

        searchSnippet = new QPushButton(guiGrid);
        searchSnippet->setObjectName(QString::fromUtf8("searchSnippet"));
        searchSnippet->setFont(font);

        gridLayout->addWidget(searchSnippet, 1, 1, 2, 1);

        previousSearchesLabel = new QLabel(guiGrid);
        previousSearchesLabel->setObjectName(QString::fromUtf8("previousSearchesLabel"));
        previousSearchesLabel->setFont(font);

        gridLayout->addWidget(previousSearchesLabel, 3, 0, 1, 2);

        previousSearchesList = new CustomComboBox(guiGrid);
        previousSearchesList->setObjectName(QString::fromUtf8("previousSearchesList"));
        QSizePolicy sizePolicy1(QSizePolicy::Expanding, QSizePolicy::Fixed);
        sizePolicy1.setHorizontalStretch(0);
        sizePolicy1.setVerticalStretch(0);
        sizePolicy1.setHeightForWidth(previousSearchesList->sizePolicy().hasHeightForWidth());
        previousSearchesList->setSizePolicy(sizePolicy1);
        previousSearchesList->setMinimumSize(QSize(0, 0));
        QFont font1;
        font1.setPointSize(11);
        font1.setBold(true);
        font1.setWeight(75);
        previousSearchesList->setFont(font1);
        previousSearchesList->setFocusPolicy(Qt::NoFocus);
        previousSearchesList->setStyleSheet(QString::fromUtf8("QComboBox\n"
"{\n"
"	padding-top: 8px;\n"
"	padding-left: 5px;\n"
"	padding-bottom: 0px;\n"
"	height: 16px;\n"
"}\n"
"\n"
"\n"
""));
        previousSearchesList->setMaxVisibleItems(10);
        previousSearchesList->setDuplicatesEnabled(true);
        previousSearchesList->setFrame(true);

        gridLayout->addWidget(previousSearchesList, 5, 0, 1, 1);

        listSnippetsLabel = new QLabel(guiGrid);
        listSnippetsLabel->setObjectName(QString::fromUtf8("listSnippetsLabel"));
        listSnippetsLabel->setFont(font);

        gridLayout->addWidget(listSnippetsLabel, 7, 0, 1, 1);

        listSnippets = new CustomTreeWidget(guiGrid);
        QTreeWidgetItem *__qtreewidgetitem = new QTreeWidgetItem();
        __qtreewidgetitem->setText(0, QString::fromUtf8("1"));
        listSnippets->setHeaderItem(__qtreewidgetitem);
        listSnippets->setObjectName(QString::fromUtf8("listSnippets"));
        listSnippets->setFont(font);
        listSnippets->setEditTriggers(QAbstractItemView::AnyKeyPressed|QAbstractItemView::SelectedClicked);
        listSnippets->setAlternatingRowColors(true);
        listSnippets->setSelectionMode(QAbstractItemView::SingleSelection);
        listSnippets->setSortingEnabled(true);
        listSnippets->setAnimated(true);
        listSnippets->header()->setCascadingSectionResizes(true);
        listSnippets->header()->setHighlightSections(false);

        gridLayout->addWidget(listSnippets, 8, 0, 1, 2);

        selectedSnippetLabel = new QLabel(guiGrid);
        selectedSnippetLabel->setObjectName(QString::fromUtf8("selectedSnippetLabel"));
        selectedSnippetLabel->setFont(font);

        gridLayout->addWidget(selectedSnippetLabel, 10, 0, 1, 1);

        selectedSnippet = new QTextEdit(guiGrid);
        selectedSnippet->setObjectName(QString::fromUtf8("selectedSnippet"));
        selectedSnippet->setFont(font);
        selectedSnippet->setAcceptDrops(false);
        selectedSnippet->setFrameShape(QFrame::StyledPanel);
        selectedSnippet->setFrameShadow(QFrame::Sunken);
        selectedSnippet->setUndoRedoEnabled(false);
        selectedSnippet->setReadOnly(true);

        gridLayout->addWidget(selectedSnippet, 11, 0, 1, 2);

        copySnippet = new QPushButton(guiGrid);
        copySnippet->setObjectName(QString::fromUtf8("copySnippet"));
        copySnippet->setEnabled(false);
        copySnippet->setFont(font);
        copySnippet->setAutoDefault(false);
        copySnippet->setDefault(false);
        copySnippet->setFlat(false);

        gridLayout->addWidget(copySnippet, 12, 0, 1, 2);

        deleteSelectedPrevSearch = new QPushButton(guiGrid);
        deleteSelectedPrevSearch->setObjectName(QString::fromUtf8("deleteSelectedPrevSearch"));
        deleteSelectedPrevSearch->setEnabled(false);
        deleteSelectedPrevSearch->setFont(font);

        gridLayout->addWidget(deleteSelectedPrevSearch, 5, 1, 1, 1);

        searchLabel = new QLabel(guiGrid);
        searchLabel->setObjectName(QString::fromUtf8("searchLabel"));
        searchLabel->setFont(font);

        gridLayout->addWidget(searchLabel, 0, 0, 1, 1);

        foundNumberOfSnippets = new QLabel(guiGrid);
        foundNumberOfSnippets->setObjectName(QString::fromUtf8("foundNumberOfSnippets"));
        foundNumberOfSnippets->setFont(font);
        foundNumberOfSnippets->setLayoutDirection(Qt::LeftToRight);
        foundNumberOfSnippets->setStyleSheet(QString::fromUtf8(""));
        foundNumberOfSnippets->setAlignment(Qt::AlignRight|Qt::AlignTrailing|Qt::AlignVCenter);

        gridLayout->addWidget(foundNumberOfSnippets, 9, 0, 1, 2);

        MainWindow->setCentralWidget(guiGrid);
        menubar = new QMenuBar(MainWindow);
        menubar->setObjectName(QString::fromUtf8("menubar"));
        menubar->setGeometry(QRect(0, 0, 909, 22));
        menuHelp = new QMenu(menubar);
        menuHelp->setObjectName(QString::fromUtf8("menuHelp"));
        MainWindow->setMenuBar(menubar);

        menubar->addAction(menuHelp->menuAction());
        menuHelp->addAction(actionPreferences);
        menuHelp->addAction(aboutSnippt);

        retranslateUi(MainWindow);

        QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
        MainWindow->setWindowTitle(QString());
        aboutSnippt->setText(QApplication::translate("MainWindow", "About Snippt", 0, QApplication::UnicodeUTF8));
        actionPreferences->setText(QApplication::translate("MainWindow", "Preferences", 0, QApplication::UnicodeUTF8));
        searchSnippet->setText(QApplication::translate("MainWindow", "Search", 0, QApplication::UnicodeUTF8));
        previousSearchesLabel->setText(QApplication::translate("MainWindow", "Previous searches:", 0, QApplication::UnicodeUTF8));
        listSnippetsLabel->setText(QApplication::translate("MainWindow", "Snippets:", 0, QApplication::UnicodeUTF8));
        selectedSnippetLabel->setText(QApplication::translate("MainWindow", "Selected snippet:", 0, QApplication::UnicodeUTF8));
        copySnippet->setText(QApplication::translate("MainWindow", "Copy snippet", 0, QApplication::UnicodeUTF8));
        deleteSelectedPrevSearch->setText(QApplication::translate("MainWindow", "Delete", 0, QApplication::UnicodeUTF8));
        searchLabel->setText(QApplication::translate("MainWindow", "Search for a snippet (use for example: word + word or just search for one single word):", 0, QApplication::UnicodeUTF8));
        foundNumberOfSnippets->setText(QString());
        menuHelp->setTitle(QApplication::translate("MainWindow", "Help", 0, QApplication::UnicodeUTF8));
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_MAINWINDOW_H
