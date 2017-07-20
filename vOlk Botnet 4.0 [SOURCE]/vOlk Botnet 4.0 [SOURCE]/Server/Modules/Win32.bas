Attribute VB_Name = "Win32"
Option Explicit
 
Private Declare Function RtlGetVersion Lib "NTDLL" (ByRef lpVersionInformation As Long) As Long
Public Function NativeGetVersion() As String
    Dim tOSVw(&H54)     As Long
    tOSVw(0) = &H54 * &H4
    Call RtlGetVersion(tOSVw(0))
    NativeGetVersion = Join(Array(tOSVw(4), tOSVw(1), tOSVw(2)), ".")
End Function
 
Public Function VersionToName(ByRef sVersion As String) As String
    Select Case sVersion
        Case "1.0.0":     VersionToName = "Windows 95"
        Case "1.1.0":     VersionToName = "Windows 98"
        Case "1.9.0":     VersionToName = "Windows Millenium"
        Case "2.3.0":     VersionToName = "Windows NT 3.51"
        Case "2.4.0":     VersionToName = "Windows NT 4.0"
        Case "2.5.0":     VersionToName = "Windows 2000"
        Case "2.5.1":     VersionToName = "Windows XP"
        Case "2.5.3":     VersionToName = "Windows 2003 (SERVER)"
        Case "2.6.0":     VersionToName = "Windows Vista"
        Case "2.6.1":     VersionToName = "Windows 7"
        Case Else:        VersionToName = "Unknown"
    End Select
End Function
