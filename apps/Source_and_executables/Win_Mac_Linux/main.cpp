// The main-class for bringing the whole
// application to life thru one method

#include <QtGui/QApplication>
#include "mainwindow.h"

// The method that make the magic happen
int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    MainWindow w;
    w.show();
    
    return a.exec();
}
