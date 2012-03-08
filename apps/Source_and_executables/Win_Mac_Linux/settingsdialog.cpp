#include "settingsdialog.h"
#include "ui_settingsdialog.h"
#include <QSettings>
#include <QMessageBox>
#include "mainwindow.h"

SettingsDialog::SettingsDialog(QWidget *parent) : QDialog(parent), ui2(new Ui::SettingsDialog)
{
    ui2->setupUi(this);

    Qt::WindowFlags flags = 0;
    flags = Qt::Dialog;
    flags |= Qt::WindowStaysOnTopHint;
    flags |= Qt::WindowCloseButtonHint;
    flags |= Qt::WindowTitleHint;
    setWindowFlags(flags);

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
}

SettingsDialog::~SettingsDialog()
{
    delete ui2;
}

void SettingsDialog::on_saveButton_clicked()
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

    QMessageBox::information(this, "Settings", "Settings have been saved!\n\nRestart the application to use the new settings with the app!");
    this->close();
}

void SettingsDialog::on_closeButton_clicked()
{
    this->close();
}
