#include "customcombobox.h"
#include <QMessageBox>
#include "mainwindow.h"

CustomComboBox::CustomComboBox(QWidget *a_parent) {}

void CustomComboBox::mousePressEvent(QMouseEvent *a_event)
{
    MainWindow *mainWindow;

    if (a_event->button() == Qt::LeftButton && this->currentText() != "")
    {
        this->showPopup();
        //this->mainWindow->FillListWithPrevSearches(this->itemData(0).toString());
    }
}

void CustomComboBox::keyPressEvent(QKeyEvent *a_event)
{

}
