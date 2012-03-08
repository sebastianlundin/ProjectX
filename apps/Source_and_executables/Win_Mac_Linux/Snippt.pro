QT       += core gui network sql

TARGET = Snippt
TEMPLATE = app

CONFIG  += qxt
QXT     += core gui

SOURCES += main.cpp\
        mainwindow.cpp \
    jsonfuncs.cpp \
    filefuncs.cpp \
    apifuncs.cpp \
    cachefuncs.cpp \
    settingsfuncs.cpp \
    settingsdialog.cpp \
    customtreewidget.cpp \
    customcombobox.cpp

HEADERS  += mainwindow.h \
    jsonfuncs.h \
    filefuncs.h \
    apifuncs.h \
    cachefuncs.h \
    settingsfuncs.h \
    settingsdialog.h \
    customtreewidget.h \
    customcombobox.h

FORMS    += \
    mainwindow.ui \
    settingsdialog.ui

macx: LIBS += -L$$PWD/libs/executables/macosx -lqjson
macx: INCLUDEPATH += $$PWD/libs/executables/macosx
macx: DEPENDPATH += $$PWD/libs/executables/macosx
