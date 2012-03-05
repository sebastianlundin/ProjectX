[Setup]
AppName=Snippt
AppVersion=1.0
AppPublisher=Jens Evertsson
AppPublisherURL=""
AppSupportURL=""
AppUpdatesURL=""
DefaultDirName={pf}\Snippt
DisableDirPage=yes
DefaultGroupName=Snippt
DisableProgramGroupPage=yes
OutputDir=C:\Documents and Settings\Administrator\Desktop
OutputBaseFilename=Snippt_1.0
Compression=lzma
SolidCompression=yes

[Languages]
Name: "english"; MessagesFile: "compiler:Default.isl"

[Tasks]
Name: "desktopicon"; Description: "{cm:CreateDesktopIcon}"; GroupDescription: "{cm:AdditionalIcons}"; Flags: unchecked

[Icons]
Name: "{group}\Snippt"; Filename: "{app}\Snippt.exe"
Name: "{group}\{cm:UninstallProgram,Limpa2k}"; Filename: "{uninstallexe}"
Name: "{commondesktop}\Snippt"; Filename: "{app}\Snippt.exe"; Tasks: desktopicon

[Run]
Filename: "{app}\Snippt.exe"; Description: "{cm:LaunchProgram,Snippt}"; Flags: nowait postinstall skipifsilent

[setup]
WizardImageFile = "snippt.bmp" 