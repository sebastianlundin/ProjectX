// The main-class for bringing the whole
// application to life thru one method

#include <QtGui/QApplication>
#include "mainwindow.h"

MainWindow *mainWindow;

// The method that make the magic happen
int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    mainWindow = new MainWindow();
    mainWindow->show();
    
    return a.exec();
}
