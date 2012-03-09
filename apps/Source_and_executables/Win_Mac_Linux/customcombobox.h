#ifndef CUSTOMCOMBOBOX_H
#define CUSTOMCOMBOBOX_H

#include <QComboBox>
#include <QWidget>
#include <QMouseEvent>

class CustomComboBox : public QComboBox
{
    Q_OBJECT

public:
    CustomComboBox(QWidget *a_parent);
    void mouseReleaseEvent(QMouseEvent *a_event);
};

#endif // CUSTOMCOMBOBOX_H
