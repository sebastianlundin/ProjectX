QT       += core gui network sql

TARGET = Snippt
TEMPLATE = app


SOURCES += main.cpp\
        mainwindow.cpp \
    jsonfuncs.cpp \
    filefuncs.cpp \
    apifuncs.cpp \
    cachefuncs.cpp

HEADERS  += mainwindow.h \
    jsonfuncs.h \
    filefuncs.h \
    apifuncs.h \
    cachefuncs.h

FORMS    += \
    mainwindow.ui

macx: LIBS += -L$$PWD/libs/executables/macosx -lqjson
macx: INCLUDEPATH += $$PWD/libs/executables/macosx
macx: DEPENDPATH += $$PWD/libs/executables/macosx
