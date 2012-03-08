#include "customcombobox.h"
#include <QMessageBox>
#include "mainwindow.h"

CustomComboBox::CustomComboBox(QWidget *a_parent) {}

void CustomComboBox::mousePressEvent(QMouseEvent *a_event)
{
    //MainWindow *mainWindow = new MainWindow(this);

    this->showPopup();

    if (a_event->button() == Qt::LeftButton)
    {
        //this->mainWindow->FillListWithPrevSearches(this->itemData(0).toString());
        //connect(this, SIGNAL(activated(QString)), mainWindow, SLOT(FillListWithPrevSearches(QString)));
    }
}

void CustomComboBox::keyPressEvent(QKeyEvent *a_event)
{

}
