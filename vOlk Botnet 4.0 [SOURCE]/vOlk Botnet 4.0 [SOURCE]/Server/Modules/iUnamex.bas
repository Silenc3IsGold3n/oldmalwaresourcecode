Attribute VB_Name = "iUnamex"
'API para obtener el usuario actual
Declare Function GetUserName Lib "advapi32.dll" Alias "GetUserNameA" _
    (ByVal lpbuffer As String, nSize As Long) As Long

'Esta función devuelve el nombre del Usuario
Public Function UnameWin32() As String
    Dim sBuffer As String
    Dim lSize As Long
    Dim sUsuario As String

    sBuffer = Space$(260)
    lSize = Len(sBuffer)
    Call GetUserName(sBuffer, lSize)
    If lSize > 0 Then
        sUsuario = Left$(sBuffer, lSize)
        'Quitarle el CHR$(0) del final...
        lSize = InStr(sUsuario, Chr$(0))
        If lSize Then
            sUsuario = Left$(sUsuario, lSize - 1)
        End If
    Else
        sUsuario = ""
    End If
    UnameWin32 = sUsuario
End Function






