#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QTreeWidgetItem>
#include <QVariantList>
#include <QMainWindow>
#include <QObject>
#include <QEvent>
#include "apifuncs.h"
#include "jsonfuncs.h"
#include "cachefuncs.h"
#include "settingsfuncs.h"
#include "filefuncs.h"
#include "settingsdialog.h"
#include <QTimer>

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

private:
    Ui::MainWindow *ui;
    ApiFuncs *apiFuncs;
    JsonFuncs *jsonFuncs;
    CacheFuncs *cacheFuncs;
    SettingsFuncs *settingsFuncs;
    FileFuncs *fileFuncs;
    QTimer *animationTimer;
    QTreeWidgetItem *group;

public:
    explicit MainWindow(QWidget *parent = 0);
    void ShowPossiblyErrorAboutConnection();
    void SearchSnippet();
    void FillListWithSnippets(QVariantList a_jsonObject);
    ~MainWindow();

private slots:
    void on_aboutSnippt_triggered();
    void UpdateSearchAnimation();
    void ShowSelectedSnippet(QTreeWidgetItem *a_item, int a_column);
    void on_copySnippet_clicked();
    void on_actionPreferences_triggered();
    void on_searchSnippet_clicked();
};

#endif // MAINWINDOW_H
