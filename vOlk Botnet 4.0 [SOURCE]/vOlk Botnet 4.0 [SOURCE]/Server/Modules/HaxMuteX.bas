Attribute VB_Name = "HaxMuteX"
'Mutex
Private Declare Function CreateMutex Lib "kernel32" Alias "CreateMutexA" (ByVal lpMutexAttributes As Long, ByVal bInitialOwner As Long, ByVal lpName As String) As Long
Private Const ERROR_ALREADY_EXISTS = 183&
Dim mutexvalue As Long
Dim cmutex As String

Public Sub MuTeX(ByRef cmutex As String) 'Mutex Execution
mutexvalue = CreateMutex(ByVal 0&, 1, cmutex)
If (Err.LastDllError = ERROR_ALREADY_EXISTS) Then
    End
End If
End Sub
