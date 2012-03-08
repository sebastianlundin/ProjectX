#ifndef CUSTOMTREEWIDGET_H
#define CUSTOMTREEWIDGET_H

#include <QTreeWidget>
#include <QKeyEvent>
#include <QWidget>

class CustomTreeWidget : public QTreeWidget
{
    Q_OBJECT

public:
    CustomTreeWidget(QWidget *a_parent);
    void keyPressEvent(QKeyEvent *a_event);
};

#endif // CUSTOMTREEWIDGET_H
