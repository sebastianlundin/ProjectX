#include "settingsdialog.h"
#include "ui_settingsdialog.h"
#include <QSettings>
#include <QMessageBox>
#include <QRegExp>
#include <QRegExpValidator>
#include <QRect>
#include <QDesktopWidget>

SettingsDialog::SettingsDialog(QWidget *parent) : QDialog(parent), ui2(new Ui::SettingsDialog)
{
    ui2->setupUi(this);

    Qt::WindowFlags flags = 0;
    flags = Qt::Dialog;
    flags |= Qt::WindowStaysOnTopHint;
    flags |= Qt::WindowCloseButtonHint;
    flags |= Qt::WindowTitleHint;
    setWindowFlags(flags);

    QRect windowGeometry = frameGeometry();
    windowGeometry.moveCenter(QDesktopWidget().availableGeometry().center());

    QVariant apiUrl, activeGlobalShortcuts, activeShortcut;
    QSettings settings("ProjectX", "Snippt");

    settings.beginGroup("SnipptSettings");

    apiUrl = settings.value("apiurl");
    QString apiUrlConv = apiUrl.toString();
    ui2->apiAddressField->setText(apiUrlConv.toUtf8());

    activeGlobalShortcuts = settings.value("activeglobalshortcuts");
    QString activeGlobalShortcutsConv = activeGlobalShortcuts.toString();

    if (activeGlobalShortcutsConv == "activated")
    {
        ui2->enableDisableGlobalShortcuts->setChecked(true);
    }
    else
    {
        ui2->enableDisableGlobalShortcuts->setChecked(false);
    }

    activeShortcut = settings.value("activeshortcut");
    QString activeShortcutConv = activeShortcut.toString();
    ui2->activeShortcutField->setText(activeShortcutConv.toUtf8());

    settings.endGroup();

    // Activate regex validator (with regex code) for the api address field
    QRegExpValidator *regexValidator1 = new QRegExpValidator(this);
    QRegExp regexCode1("[a-z:/.]*");
    regexCode1.setCaseSensitivity(Qt::CaseInsensitive);
    regexValidator1->setRegExp(regexCode1);
    ui2->apiAddressField->setValidator(regexValidator1);

    // Activate regex validator (with regex code) for the field that holds the keyboard setting for bringing
    // the whole application to front/focus with some keys (if it's activated in the settings)
    QRegExpValidator *regexValidator2 = new QRegExpValidator(this);
    QRegExp regexCode2("[ctrl|alt|cmd|shift]{0,5}[+]{0,1}[a-z|ctrl|alt|cmd|shift]{0,5}[0-9]{0,1}[+]{0,1}[a-z]{0,1}[0-9]{0,1}");
    regexCode2.setCaseSensitivity(Qt::CaseInsensitive);
    regexValidator2->setRegExp(regexCode2);
    ui2->activeShortcutField->setValidator(regexValidator2);
}

SettingsDialog::~SettingsDialog()
{
    delete ui2;
}

void SettingsDialog::on_saveButton_clicked()
{
    QRegExp regexCode1("[a-z:/.]*");
    QRegExp regexCode2("[ctrl|alt|cmd|shift]{0,5}[+]{0,1}[a-z|ctrl|alt|cmd|shift]{0,5}[0-9]{0,1}[+]{0,1}[a-z]{0,1}[0-9]{0,1}");
    bool isAddressValid = regexCode1.exactMatch(ui2->apiAddressField->text());
    bool isActiveKeyValid = regexCode1.exactMatch(ui2->apiAddressField->text());

    if (isAddressValid == true && isActiveKeyValid == true)
    {
        QSettings settings("ProjectX", "Snippt");
        settings.beginGroup("SnipptSettings");
        settings.setValue("apiurl", ui2->apiAddressField->text());

        if (ui2->enableDisableGlobalShortcuts->isChecked() == true)
        {
            settings.setValue("activeglobalshortcuts", "activated");
        }
        else
        {
            settings.setValue("activeglobalshortcuts", "deactivated");
        }

        settings.setValue("activeshortcut", ui2->activeShortcutField->text());
        settings.endGroup();
        settings.sync();

        QMessageBox::information(this, "Preferences", "Preferences has been saved!");
        emit UpdateKeyboardSettings();
        this->close();
    }
    else if (isAddressValid == false)
    {
        QMessageBox::warning(this, "Api address is not valid!", "Api address is not valid!\n\nOnly letters, periods, slashes and colon is supported.\n\nTry again!");
    }
    else if (isActiveKeyValid == false)
    {
        QMessageBox::warning(this, "Active key is not valid!", "Active key is not valid!\n\nOnly letters, plus and numbers is supported.\n\nTry again!");
    }
}

void SettingsDialog::on_closeButton_clicked()
{
    this->close();
}
