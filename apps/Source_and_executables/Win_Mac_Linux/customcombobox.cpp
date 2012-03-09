#include "customcombobox.h"
#include <QMessageBox>
#include "mainwindow.h"

CustomComboBox::CustomComboBox(QWidget *a_parent) {}

void CustomComboBox::mouseReleaseEvent(QMouseEvent *a_event)
{
    this->showPopup();
}
