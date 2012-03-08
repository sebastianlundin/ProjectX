#include "customtreewidget.h"
#include <QTreeWidgetItem>
#include <QTreeWidget>

CustomTreeWidget::CustomTreeWidget(QWidget *a_parent) {}

void CustomTreeWidget::keyPressEvent(QKeyEvent *a_event)
{
    if (a_event->key() == Qt::Key_Up)
    {
        setCurrentIndex(indexAbove(currentIndex()));
        if (this->currentItem() != 0)
        {
            emit clicked(currentIndex());
        }
    }
    else if (a_event->key() == Qt::Key_Down)
    {
        setCurrentIndex(indexBelow(currentIndex()));
        if (this->currentItem() != 0)
        {
            emit clicked(currentIndex());
        }
    }
    else if (a_event->key() == Qt::Key_Left)
    {
        if (this->currentItem() != 0)
        {
            this->currentItem()->setExpanded(false);
        }
    }
    else if (a_event->key() == Qt::Key_Right)
    {
        if (this->currentItem() != 0)
        {
            this->currentItem()->setExpanded(true);
        }
    }
}
