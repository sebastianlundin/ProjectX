#include "filefuncs.h"
#include <QFile>
#include <QDir>
#include <QTextStream>
#include <QDateTime>
#include <QDirIterator>

QString FileFuncs::GetUserDir()
{
    return QDir::homePath().toUtf8() + "/snippt_cache_files/";
}

bool FileFuncs::CheckIfFileExists(QString a_filename)
{
    QFile file(this->GetUserDir() + a_filename);
    if (file.open(QIODevice::ReadOnly) == false)
    {
        file.close();
        return false;
    }
    file.close();
    return true;
}

bool FileFuncs::CheckIfCacheDirExists()
{
    if (QDir().exists(this->GetUserDir()) == true)
    {
        return true;
    }
    return false;
}

QString FileFuncs::GetUnixTime(int a_time)
{
    QDateTime currentDateAndTime = QDateTime::currentDateTime();
    QString unixTime = QString::number(currentDateAndTime.toTime_t() + a_time);
    QString dateToString = unixTime.toUtf8();
    return dateToString;
}

bool FileFuncs::SaveFile(QString a_filename, QByteArray a_data, QString a_search)
{
    if (this->CheckIfCacheDirExists() == false)
    {
        QDir().mkdir(this->GetUserDir());
    }

    QFile file(this->GetUserDir() + a_filename);
    if (file.open(QIODevice::ReadWrite) == false)
    {
        return false;
    }

    QTextStream out(&file);

    out << "";

    QString dateToString = this->GetUnixTime(20); // Add one hour into the future

    out << dateToString + "\n";
    out << a_search + "\n";
    out << a_data;

    file.close();
    return true;
}

bool FileFuncs::CheckIfFileIsTheLatest(QString a_filename)
{
    QFile file(this->GetUserDir() + a_filename);
    file.open(QIODevice::ReadOnly);

    if (this->CheckIfFileExists(a_filename) == true)
    {
        if (this->GetUnixTime(0) > file.readLine())
        {
            return false;
        }
    }

    file.close();
    return true;
}

QByteArray FileFuncs::LoadFile(QString a_filename)
{
    QByteArray data;
    QFile file(this->GetUserDir() + a_filename);
    file.open(QIODevice::ReadOnly);

    if (this->CheckIfFileExists(a_filename) == true)
    {
        file.readLine();
        file.readLine();

        while (!file.atEnd())
        {
            data.append(file.readLine());
        }
    }

    file.close();
    return data;
}

void FileFuncs::ListSearchFiles()
{
    QDirIterator listFilesFromCacheDirectory(this->GetUserDir(), QDir::Files);

    while (listFilesFromCacheDirectory.hasNext())
    {

    }
}
