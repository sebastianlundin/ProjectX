#ifndef CACHEFUNCS_H
#define CACHEFUNCS_H

#include <QObject>
#include <QByteArray>
#include <QString>

class CacheFuncs : public QObject
{
    Q_OBJECT
public:
    explicit CacheFuncs(QObject *parent = 0);
    QByteArray GetCacheFileData(QString a_filename);
    
signals:
    
public slots:
    
};

#endif // CACHEFUNCS_H
