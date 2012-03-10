// Class (header-file) for the preferences dialog

// Beginning of header-file
#ifndef SETTINGSDIALOG_H
#define SETTINGSDIALOG_H

// Includes all the importen libs (in qt)
// that we need to use for this class to work
#include <QDialog>
#include <QObject>
#include <QEvent>

// Namespace for the class
namespace Ui {
class SettingsDialog;
}

// Beginning of the class
class SettingsDialog : public QDialog // Subclass of the qdialog, so that we can add extra functionality to the window
{
    Q_OBJECT // A macro for making magic happen, when it comes to calling other classes from a class
    
// Methods for the class
public:

    // Constructor
    explicit SettingsDialog(QWidget *parent = 0);

    // Destructor
    ~SettingsDialog();
    
// Slots for the class (a slot is a method, that a signal can call (like events))
private slots:

    // Save the given settings and close the window
    void on_saveButton_clicked();

    // Close the window
    void on_closeButton_clicked();

    // Enables/disables the keyboard shortcut field
    void on_enableDisableGlobalShortcuts_clicked();

// Member variables of the class
private:
    Ui::SettingsDialog *ui2; // Pointer to the interface-file (settingsdialog)

// Signals for the class (a signal is a thing, like a event to listen for and opens a
// slot (a method) when its cached)
signals:

    // When settings are updated, update the mainwindow
    // with the api address and keyboardsettings
    void UpdateKeyboardSettings();
};
// Ending of the class

#endif // SETTINGSDIALOG_H
// Ending of header-file
