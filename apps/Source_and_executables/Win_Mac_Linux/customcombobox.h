#ifndef CUSTOMCOMBOBOX_H
#define CUSTOMCOMBOBOX_H

#include <QComboBox>
#include <QWidget>
#include <QKeyEvent>
#include <QMouseEvent>

class CustomComboBox : public QComboBox
{
    Q_OBJECT

public:
    CustomComboBox(QWidget *a_parent);
    void mouseReleaseEvent(QMouseEvent *a_event);
    void keyPressEvent(QKeyEvent *a_event);
};

#endif // CUSTOMCOMBOBOX_H
