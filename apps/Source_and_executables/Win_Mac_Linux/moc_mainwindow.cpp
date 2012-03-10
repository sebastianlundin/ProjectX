/****************************************************************************
** Meta object code from reading C++ file 'mainwindow.h'
**
** Created: Sun Mar 11 00:09:30 2012
**      by: The Qt Meta Object Compiler version 63 (Qt 4.8.0)
**
** WARNING! All changes made in this file will be lost!
*****************************************************************************/

#include "mainwindow.h"
#if !defined(Q_MOC_OUTPUT_REVISION)
#error "The header file 'mainwindow.h' doesn't include <QObject>."
#elif Q_MOC_OUTPUT_REVISION != 63
#error "This file was generated using the moc from 4.8.0. It"
#error "cannot be used with the include files from this version of Qt."
#error "(The moc has changed too much.)"
#endif

QT_BEGIN_MOC_NAMESPACE
static const uint qt_meta_data_MainWindow[] = {

 // content:
       6,       // revision
       0,       // classname
       0,    0, // classinfo
      16,   14, // methods
       0,    0, // properties
       0,    0, // enums/sets
       0,    0, // constructors
       0,       // flags
       0,       // signalCount

 // slots: signature, parameters, type, tag, flags
      12,   11,   11,   11, 0x08,
      39,   11,   11,   11, 0x08,
      57,   11,   11,   11, 0x08,
      89,   11,   11,   11, 0x08,
     107,   11,   11,   11, 0x08,
     164,  147,  142,   11, 0x08,
     194,   11,   11,   11, 0x08,
     210,   11,   11,   11, 0x08,
     250,  234,   11,   11, 0x08,
     292,   11,   11,   11, 0x08,
     314,  306,   11,   11, 0x08,
     344,   11,   11,   11, 0x08,
     366,   11,   11,   11, 0x08,
     391,   11,   11,   11, 0x08,
     424,   11,   11,   11, 0x08,
     451,   11,   11,   11, 0x08,

       0        // eod
};

static const char qt_meta_stringdata_MainWindow[] = {
    "MainWindow\0\0on_aboutSnippt_triggered()\0"
    "KeyboardActions()\0ShowWindowAndFocusSearchField()\0"
    "ShowAllElements()\0ShowAndHideElementsWithNewSearch()\0"
    "bool\0a_object,a_event\0"
    "eventFilter(QObject*,QEvent*)\0"
    "SearchSnippet()\0UpdateSearchAnimation()\0"
    "a_item,a_column\0"
    "ShowSelectedSnippet(QTreeWidgetItem*,int)\0"
    "ClearFields()\0a_index\0"
    "FillListWithPrevSearches(int)\0"
    "CopySelectedSnippet()\0on_copySnippet_clicked()\0"
    "on_actionPreferences_triggered()\0"
    "on_searchSnippet_clicked()\0"
    "on_deleteSelectedPrevSearch_clicked()\0"
};

void MainWindow::qt_static_metacall(QObject *_o, QMetaObject::Call _c, int _id, void **_a)
{
    if (_c == QMetaObject::InvokeMetaMethod) {
        Q_ASSERT(staticMetaObject.cast(_o));
        MainWindow *_t = static_cast<MainWindow *>(_o);
        switch (_id) {
        case 0: _t->on_aboutSnippt_triggered(); break;
        case 1: _t->KeyboardActions(); break;
        case 2: _t->ShowWindowAndFocusSearchField(); break;
        case 3: _t->ShowAllElements(); break;
        case 4: _t->ShowAndHideElementsWithNewSearch(); break;
        case 5: { bool _r = _t->eventFilter((*reinterpret_cast< QObject*(*)>(_a[1])),(*reinterpret_cast< QEvent*(*)>(_a[2])));
            if (_a[0]) *reinterpret_cast< bool*>(_a[0]) = _r; }  break;
        case 6: _t->SearchSnippet(); break;
        case 7: _t->UpdateSearchAnimation(); break;
        case 8: _t->ShowSelectedSnippet((*reinterpret_cast< QTreeWidgetItem*(*)>(_a[1])),(*reinterpret_cast< int(*)>(_a[2]))); break;
        case 9: _t->ClearFields(); break;
        case 10: _t->FillListWithPrevSearches((*reinterpret_cast< int(*)>(_a[1]))); break;
        case 11: _t->CopySelectedSnippet(); break;
        case 12: _t->on_copySnippet_clicked(); break;
        case 13: _t->on_actionPreferences_triggered(); break;
        case 14: _t->on_searchSnippet_clicked(); break;
        case 15: _t->on_deleteSelectedPrevSearch_clicked(); break;
        default: ;
        }
    }
}

const QMetaObjectExtraData MainWindow::staticMetaObjectExtraData = {
    0,  qt_static_metacall 
};

const QMetaObject MainWindow::staticMetaObject = {
    { &QMainWindow::staticMetaObject, qt_meta_stringdata_MainWindow,
      qt_meta_data_MainWindow, &staticMetaObjectExtraData }
};

#ifdef Q_NO_DATA_RELOCATION
const QMetaObject &MainWindow::getStaticMetaObject() { return staticMetaObject; }
#endif //Q_NO_DATA_RELOCATION

const QMetaObject *MainWindow::metaObject() const
{
    return QObject::d_ptr->metaObject ? QObject::d_ptr->metaObject : &staticMetaObject;
}

void *MainWindow::qt_metacast(const char *_clname)
{
    if (!_clname) return 0;
    if (!strcmp(_clname, qt_meta_stringdata_MainWindow))
        return static_cast<void*>(const_cast< MainWindow*>(this));
    return QMainWindow::qt_metacast(_clname);
}

int MainWindow::qt_metacall(QMetaObject::Call _c, int _id, void **_a)
{
    _id = QMainWindow::qt_metacall(_c, _id, _a);
    if (_id < 0)
        return _id;
    if (_c == QMetaObject::InvokeMetaMethod) {
        if (_id < 16)
            qt_static_metacall(this, _c, _id, _a);
        _id -= 16;
    }
    return _id;
}
QT_END_MOC_NAMESPACE
