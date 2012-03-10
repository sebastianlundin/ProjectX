// Class (header-file) for getting the api-adress from settings

// Beginning of header-file
#ifndef SETTINGSFUNCS_H
#define SETTINGSFUNCS_H

// Includes all the importen libs (in qt)
// that we need to use for this class to work
#include <QString>

// Beginning of the class
class SettingsFuncs
{

// Methods for the class
public:

    // Get the api-adress from settings.
    // If there isn't any adress in the
    // settings. Use a default-adress of
    // http://tmpn.se/api instead
    QString GetApiUrl();
};
// Ending of the class

#endif // SETTINGSFUNCS_H
// Ending of header-file
