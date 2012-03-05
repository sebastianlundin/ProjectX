#include "cachefuncs.h"
#include "filefuncs.h"

CacheFuncs::CacheFuncs(QObject *parent) : QObject(parent){}

QByteArray CacheFuncs::GetCacheFileData(QString a_filename)
{
    FileFuncs *fileFuncs = new FileFuncs();
    QByteArray data;
    data = fileFuncs->LoadFile(a_filename);
    return data;
}
