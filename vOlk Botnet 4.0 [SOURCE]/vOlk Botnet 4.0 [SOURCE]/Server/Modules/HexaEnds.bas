Attribute VB_Name = "HexaEnds"
Option Explicit
Private Function ConvToInt(x As String) As Integer
          
        Dim x1 As String
        Dim x2 As String
        Dim Temp As Integer
          
        x1 = Mid(x, 1, 1)
        x2 = Mid(x, 2, 1)
          
        If IsNumeric(x1) Then
            Temp = 16 * Int(x1)
        Else
            Temp = (Asc(x1) - 55) * 16
        End If
          
        If IsNumeric(x2) Then
            Temp = Temp + Int(x2)
        Else
            Temp = Temp + (Asc(x2) - 55)
        End If
          
        ' retorno
        ConvToInt = Temp
          
    End Function
Function Desencriptar(DataValue As Variant) As Variant
          
        Dim x As Long
        Dim Temp As String
        Dim HexByte As String
          
        For x = 1 To Len(DataValue) Step 2
              
            HexByte = Mid(DataValue, x, 2)
            Temp = Temp & Chr(ConvToInt(HexByte))
              
        Next x
        ' retorno
        Desencriptar = Temp
          
End Function


