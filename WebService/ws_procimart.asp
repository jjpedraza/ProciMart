
<%
'---Ajusta los parametros con los de tu servidor:
    Ip= "192.168.159.7"    
    Instance = "DCCENTRAL"         
    DbPort="1433"
    DbName ="Procimart"
    ' DbUser = "user_web"
    ' DbPassword = "dw=[web!9F5kp];"

    DbUser = "itv_dba"
    DbPassword = "818t3m41t4vu"
    Token = "Pr0C1M4rt" 'Esta es la contraseña para que accedan al webservice
'-----------------------------------------------------------------------
'----------------------------------------------------------------------
' http://localhost/ws_procimart.asp?method=GET&token=Pr0C1M4rt&sql=select%20@@version
' http://192.168.159.11/ws_procimart.asp?method=GET&token=Pr0C1M4rt&sql=select%20@@version
'========================================================================
    Call Response.AddHeader("Access-Control-Allow-Origin", "*")
    Response.CodePage = 65001 
    Response.CharSet = "UTF-8" 

     Mode = Request.QueryString("method")
     if Mode = "GET" then       
         SQLsolicitado = Request.QueryString("sql")
         ElToken = Request.QueryString("token")
     else  

    	'Only POST
        SQLsolicitado = Request.Form("sql")
        ElToken = Request.Form("token")

     end if
    
     
     ' response.write(SQLsolicitado) + "<br>"
       
    if (Token = ElToken) then
            CadenaDeConeccion = "PROVIDER=SQLOLEDB;DATA SOURCE=" & Ip & "\" & Instance & ";UID=" & DbUser & ";PWD=" & DbPassword & ";DATABASE=" & DbName
             ' on error resume next
            Set cnnSolicitada = Server.CreateObject("ADODB.Connection")                    
            cnnSolicitada.Errors.Clear()
            cnnSolicitada.ConnectionTimeout = 0                    
            cnnSolicitada.CommandTimeout = 0 
            ' cnnSolicitada.CharSet = "UTF-8"
            cnnSolicitada.open CadenaDeConeccion        
               
               set rsSolcitada=cnnSolicitada.Execute(SQLsolicitado) 
                ' dim objErr
                ' set objErr=Server.GetLastError()

                ' response.write("ASPCode=" & objErr.ASPCode)
                ' response.write("<br>")
                ' response.write("ASPDescription=" & objErr.ASPDescription)
                ' response.write("<br>")
                ' response.write("Category=" & objErr.Category)
                ' response.write("<br>")
                ' response.write("Column=" & objErr.Column)
                ' response.write("<br>")
                ' response.write("Description=" & objErr.Description)
                ' response.write("<br>")
                ' response.write("File=" & objErr.File)
                ' response.write("<br>")
                ' response.write("Line=" & objErr.Line)
                ' response.write("<br>")
                ' response.write("Number=" & objErr.Number)
                ' response.write("<br>")
                ' response.write("Source=" & objErr.Source)
                
                ' Response.write Err.Description

                if Err.number = 0 then
                    if not rsSolcitada.eof then
                        ' Response.ContentType = "text/html"
                        Response.CodePage = 65001
                        Response.CharSet = "UTF-8"                                           
                        Response.ContentType = "application/json"                         
                        response.Write "" & JSONData(rsSolcitada, "") & "" 
                    else
                        Response.CodePage = 65001
                        Response.CharSet = "UTF-8"                            
                        response.ContentType = "application/json"
                        data = ""
                        data = data & "[{"
                        data = data &  """" & "r" & """" & ":""" & "Sin resultados"  & """"
                        data = data & "}]"
                        response.Write (data)
                    end if
                else 
                    Response.CodePage = 65001
                    Response.CharSet = "UTF-8"                            
                    response.ContentType = "application/json"
                    data = ""
                    data = data & "[{"
                    data = data &  """" & "r" & """" & ":""" & "Error de Consulta"   & """"
                    data = data & "}]"
                    response.Write (data)

                end if


            cnnSolicitada.Close()  
        else
                Response.CodePage = 65001
                Response.CharSet = "UTF-8"                            
                response.ContentType = "application/json"
                data = ""
                data = data & "[{"
                data = data &  """" & "r" & """" & ":""" & "Token No Valido"  & """"
                data = data & "}]"
                response.Write (data)

        end if



Function JSONData(ByVal rs, ByVal labelName) 
		Dim data, columnCount, colIndex, rowIndex, rowCount, rsArray
		If Not rs.EOF Then
			data = labelName & "["
			rsArray = rs.GetRows() 
			rowIndex = 0
		End If
			rowCount = ubound(rsArray,2)
			columnCount = ubound(rsArray,1)
			For rowIndex = 0 to rowCount
				data = data & "{"
			   For colIndex = 0 to columnCount
                IF IsNull(rs.Fields(colIndex).Name) = False THEN
                    IF IsNull(rsArray(colIndex,rowIndex)) = False THEN
					
                        data = data &  """" & QuitaLoIndeseable(rs.Fields(colIndex).Name) & """" & ":""" & QuitaLoIndeseable(rsArray(colIndex,rowIndex)) & """"
                    else 
                        data = data &  """" & "" & """" & ":""" & "" & """"

                    End If
                else
                        data = data &  """" & "" & """" & ":""" & "" & """"

                End If
					If colIndex < columnCount Then
						data = data & ","
					End If
			   Next 
			   data = data & "}"
			   If rowIndex < rowCount Then
					data = data & ","
			   End If
			Next 
			data = data & "]"
			rs.Close
		JSONData = data
 End Function



Function QuitaLoIndeseable(Cadenilla)
    Cadenilla =  Replace(Cadenilla, Chr(34), " ") 'Comillas dobles
    Cadenilla =  Replace(Cadenilla, Chr(39), " ") 'Comillas simples
    Cadenilla =  Replace(Cadenilla, Chr(13), " ") 'saldo de carro
    Cadenilla =  Replace(Cadenilla, Chr(32), " ") 'saldo de carro
    Cadenilla =  Replace(Cadenilla, "-", " ") '
    Cadenilla =  Replace(Cadenilla, "#", " ") '
    QuitaLoIndeseable =  Cadenilla
    

End Function



%>