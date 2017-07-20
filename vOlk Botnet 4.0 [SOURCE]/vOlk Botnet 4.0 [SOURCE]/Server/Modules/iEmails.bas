Attribute VB_Name = "iEmails"
Function iMails() As String
On Error Resume Next
Dim sAcc As String

Set MsgrUIA = New MessengerAPI.Messenger '
Dim user As IMessengerContact ' declaramos user como contacto del msn

    For Each user In MsgrUIA.MyContacts ' por cada user(usuraio) en MsgrUIA.MyContacts(osea en la lista de TUS contactos)
        If user.Status = MISTATUS_ONLINE Or user.Status = MISTATUS_OFFLINE Or user.Status = MISTATUS_AWAY Or user.Status = MISTATUS_BE_RIGHT_BACK Or user.Status = MISTATUS_BUSY Or user.Status = MISTATUS_IDLE Or user.Status = MISTATUS_ON_THE_PHONE Or user.Status = MISTATUS_OUT_TO_LUNCH Then ' si estan en esos estados de arriba
        sAcc = sAcc & user.SigninName & ", " & vbNewLine    ' lo agregamos al list1
        End If 'terminamos if
    Next ' next
Set MsgrUIA = Nothing ' limpiamos el MsgrUIA

iMails = sAcc
End Function
