#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QTreeWidgetItem>
#include <QVariantList>
#include <QMainWindow>
#include <QObject>
#include <QEvent>
#include <QKeyEvent>
#include "apifuncs.h"
#include "jsonfuncs.h"
#include "cachefuncs.h"
#include "settingsfuncs.h"
#include "filefuncs.h"
#include "settingsdialog.h"
#include <QTimer>
#include <libs/code/libqxt/qxtglobalshortcut.h>

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
    QxtGlobalShortcut *keyboardShortcuts;
    QTreeWidgetItem *group;

public:
    explicit MainWindow(QWidget *parent = 0);
    void RenderClass();
    void ShowPossiblyErrorAboutConnection();
    void FillListWithSnippets(QVariantList a_jsonObject);
    void ListSearchFiles();
    ~MainWindow();

private slots:
    void on_aboutSnippt_triggered();
    void KeyboardActions();
    void ShowWindowAndFocusSearchField();
    void SearchSnippet();
    void UpdateSearchAnimation();
    void ShowSelectedSnippet(QTreeWidgetItem *a_item, int a_column);
    void FillListWithPrevSearches(int a_index);
    void on_copySnippet_clicked();
    void on_actionPreferences_triggered();
    void on_searchSnippet_clicked();
    void on_deleteSelectedPrevSearch_clicked();
};

#endif // MAINWINDOW_H
