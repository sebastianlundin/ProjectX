#ifndef SETTINGSDIALOG_H
#define SETTINGSDIALOG_H

#include <QDialog>

namespace Ui {
class SettingsDialog;
}

class SettingsDialog : public QDialog
{
    Q_OBJECT
    
public:
    explicit SettingsDialog(QWidget *parent = 0);
    ~SettingsDialog();
    
private slots:
    void on_saveButton_clicked();

    void on_closeButton_clicked();

private:
    Ui::SettingsDialog *ui2;
};

#endif // SETTINGSDIALOG_H
