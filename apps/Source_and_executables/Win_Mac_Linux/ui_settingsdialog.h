/********************************************************************************
** Form generated from reading UI file 'settingsdialog.ui'
**
** Created: Fri Mar 9 18:24:47 2012
**      by: Qt User Interface Compiler version 4.8.0
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_SETTINGSDIALOG_H
#define UI_SETTINGSDIALOG_H

#include <QtCore/QVariant>
#include <QtGui/QAction>
#include <QtGui/QApplication>
#include <QtGui/QButtonGroup>
#include <QtGui/QCheckBox>
#include <QtGui/QDialog>
#include <QtGui/QFrame>
#include <QtGui/QGridLayout>
#include <QtGui/QGroupBox>
#include <QtGui/QHeaderView>
#include <QtGui/QLabel>
#include <QtGui/QLineEdit>
#include <QtGui/QPushButton>

QT_BEGIN_NAMESPACE

class Ui_SettingsDialog
{
public:
    QGridLayout *gridLayout;
    QGroupBox *settingsFrame;
    QGridLayout *gridLayout_2;
    QLineEdit *apiAddressField;
    QFrame *frame;
    QGridLayout *gridLayout_3;
    QCheckBox *enableDisableGlobalShortcuts;
    QLabel *keyboardShortcutActiveLabel;
    QLineEdit *activeShortcutField;
    QLabel *apiAddressLabel;
    QPushButton *saveButton;
    QPushButton *closeButton;

    void setupUi(QDialog *SettingsDialog)
    {
        if (SettingsDialog->objectName().isEmpty())
            SettingsDialog->setObjectName(QString::fromUtf8("SettingsDialog"));
        SettingsDialog->setWindowModality(Qt::NonModal);
        SettingsDialog->resize(500, 250);
        QSizePolicy sizePolicy(QSizePolicy::Fixed, QSizePolicy::Fixed);
        sizePolicy.setHorizontalStretch(0);
        sizePolicy.setVerticalStretch(0);
        sizePolicy.setHeightForWidth(SettingsDialog->sizePolicy().hasHeightForWidth());
        SettingsDialog->setSizePolicy(sizePolicy);
        SettingsDialog->setMinimumSize(QSize(500, 250));
        SettingsDialog->setMaximumSize(QSize(500, 250));
        QFont font;
        font.setPointSize(11);
        SettingsDialog->setFont(font);
        SettingsDialog->setModal(true);
        gridLayout = new QGridLayout(SettingsDialog);
        gridLayout->setObjectName(QString::fromUtf8("gridLayout"));
        gridLayout->setSizeConstraint(QLayout::SetDefaultConstraint);
        settingsFrame = new QGroupBox(SettingsDialog);
        settingsFrame->setObjectName(QString::fromUtf8("settingsFrame"));
        QSizePolicy sizePolicy1(QSizePolicy::Preferred, QSizePolicy::Expanding);
        sizePolicy1.setHorizontalStretch(0);
        sizePolicy1.setVerticalStretch(0);
        sizePolicy1.setHeightForWidth(settingsFrame->sizePolicy().hasHeightForWidth());
        settingsFrame->setSizePolicy(sizePolicy1);
        gridLayout_2 = new QGridLayout(settingsFrame);
        gridLayout_2->setObjectName(QString::fromUtf8("gridLayout_2"));
        gridLayout_2->setContentsMargins(-1, 0, -1, 7);
        apiAddressField = new QLineEdit(settingsFrame);
        apiAddressField->setObjectName(QString::fromUtf8("apiAddressField"));
        apiAddressField->setFont(font);

        gridLayout_2->addWidget(apiAddressField, 2, 0, 1, 1);

        frame = new QFrame(settingsFrame);
        frame->setObjectName(QString::fromUtf8("frame"));
        frame->setFrameShape(QFrame::StyledPanel);
        frame->setFrameShadow(QFrame::Raised);
        gridLayout_3 = new QGridLayout(frame);
        gridLayout_3->setObjectName(QString::fromUtf8("gridLayout_3"));
        enableDisableGlobalShortcuts = new QCheckBox(frame);
        enableDisableGlobalShortcuts->setObjectName(QString::fromUtf8("enableDisableGlobalShortcuts"));
        enableDisableGlobalShortcuts->setFont(font);

        gridLayout_3->addWidget(enableDisableGlobalShortcuts, 0, 0, 1, 1);

        keyboardShortcutActiveLabel = new QLabel(frame);
        keyboardShortcutActiveLabel->setObjectName(QString::fromUtf8("keyboardShortcutActiveLabel"));
        keyboardShortcutActiveLabel->setFont(font);
        keyboardShortcutActiveLabel->setLineWidth(2);
        keyboardShortcutActiveLabel->setWordWrap(true);

        gridLayout_3->addWidget(keyboardShortcutActiveLabel, 1, 0, 1, 1);

        activeShortcutField = new QLineEdit(frame);
        activeShortcutField->setObjectName(QString::fromUtf8("activeShortcutField"));
        activeShortcutField->setFont(font);

        gridLayout_3->addWidget(activeShortcutField, 2, 0, 1, 1);


        gridLayout_2->addWidget(frame, 3, 0, 1, 1);

        apiAddressLabel = new QLabel(settingsFrame);
        apiAddressLabel->setObjectName(QString::fromUtf8("apiAddressLabel"));
        QSizePolicy sizePolicy2(QSizePolicy::Preferred, QSizePolicy::Fixed);
        sizePolicy2.setHorizontalStretch(0);
        sizePolicy2.setVerticalStretch(0);
        sizePolicy2.setHeightForWidth(apiAddressLabel->sizePolicy().hasHeightForWidth());
        apiAddressLabel->setSizePolicy(sizePolicy2);
        apiAddressLabel->setFont(font);
        apiAddressLabel->setLineWidth(4);

        gridLayout_2->addWidget(apiAddressLabel, 1, 0, 1, 1);


        gridLayout->addWidget(settingsFrame, 0, 0, 1, 2);

        saveButton = new QPushButton(SettingsDialog);
        saveButton->setObjectName(QString::fromUtf8("saveButton"));
        saveButton->setFont(font);

        gridLayout->addWidget(saveButton, 1, 0, 1, 1);

        closeButton = new QPushButton(SettingsDialog);
        closeButton->setObjectName(QString::fromUtf8("closeButton"));
        closeButton->setFont(font);

        gridLayout->addWidget(closeButton, 1, 1, 1, 1);

        QWidget::setTabOrder(apiAddressField, enableDisableGlobalShortcuts);
        QWidget::setTabOrder(enableDisableGlobalShortcuts, activeShortcutField);
        QWidget::setTabOrder(activeShortcutField, saveButton);
        QWidget::setTabOrder(saveButton, closeButton);

        retranslateUi(SettingsDialog);

        QMetaObject::connectSlotsByName(SettingsDialog);
    } // setupUi

    void retranslateUi(QDialog *SettingsDialog)
    {
        SettingsDialog->setWindowTitle(QApplication::translate("SettingsDialog", "Preferences", 0, QApplication::UnicodeUTF8));
        settingsFrame->setTitle(QString());
        enableDisableGlobalShortcuts->setText(QApplication::translate("SettingsDialog", "Enable global shortcuts", 0, QApplication::UnicodeUTF8));
        keyboardShortcutActiveLabel->setText(QApplication::translate("SettingsDialog", "Choose a keyboard shortcut for make the app active \n"
"(for example: Ctrl+l):", 0, QApplication::UnicodeUTF8));
        apiAddressLabel->setText(QApplication::translate("SettingsDialog", "Api address (for example http://tmpn.se/api):", 0, QApplication::UnicodeUTF8));
        saveButton->setText(QApplication::translate("SettingsDialog", "Save changes and close this window", 0, QApplication::UnicodeUTF8));
        closeButton->setText(QApplication::translate("SettingsDialog", "Close without saving", 0, QApplication::UnicodeUTF8));
    } // retranslateUi

};

namespace Ui {
    class SettingsDialog: public Ui_SettingsDialog {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_SETTINGSDIALOG_H
