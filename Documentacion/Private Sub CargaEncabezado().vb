Private Sub CargaEncabezado()
    Dim Rst_DetalleDelProducto  As ADODB.Recordset
    Set Rst_DetalleDelProducto = New ADODB.Recordset
    
    Me.lblClaveInterna.Caption = Format(Val(Mid(Guarda_CveProducto, 3, 7)), "0000000")

    Ventas_DescripcionUnidadDeM = Obtiene_Ventas_UnidadDeMedida("UnidadDeMedida", Mid(Guarda_CveProducto, 10, 3))
    Ventas_ValorUnidadDeM = Obtiene_Ventas_UnidadDeMedida("ValorDeConversion", Mid(Guarda_CveProducto, 10, 3))
    
    Cr_Criterio = ""
    If Mid(Guarda_CveProducto, 1, 1) = "A" Then
        Cr_Criterio = Cr_Criterio & " Select * from InventarioDeAceites('" & Ventas_DescripcionUnidadDeM & "'," & Ventas_ValorUnidadDeM & " ) "
        Cr_Criterio = Cr_Criterio & " Where IdAceiteLote = " & Val(Me.lblClaveInterna.Caption)
        If Mid(Guarda_CveProducto, 2, 1) = "A" Then Cr_Criterio = Cr_Criterio & " And Tipo = 'ESENCIAL'"
        If Mid(Guarda_CveProducto, 2, 1) = "B" Then Cr_Criterio = Cr_Criterio & " And Tipo = 'AROMA'"
        If Mid(Guarda_CveProducto, 2, 1) = "C" Then Cr_Criterio = Cr_Criterio & " And Tipo = 'ESENCIA'"
        If Mid(Guarda_CveProducto, 2, 1) = "D" Then Cr_Criterio = Cr_Criterio & " And Tipo = 'DESTILADO'"
    End If
    
    With Rst_DetalleDelProducto
        If .State = 1 Then .Close
        .Open Cr_Criterio, Conexion, adOpenStatic, adLockReadOnly
        If Not (.EOF And .BOF) Then
            Rem ------------------------- Inventarios de Aceites ----------------------------------
            If Mid(Guarda_CveProducto, 1, 1) = "A" Then
                Me.lblAldehidos.Caption = IIf(IsNull(Rst_DetalleDelProducto!Aldehidos), "-.-", Format(Rst_DetalleDelProducto!Aldehidos, "#0.00"))
                Me.lblFruta.Caption = "LOTE " & IIf(IsNull(Rst_DetalleDelProducto!Tipo), "", Rst_DetalleDelProducto!Tipo) & " (" & IIf(IsNull(Rst_DetalleDelProducto!Fruta), "", Rst_DetalleDelProducto!Fruta) & ")"
                Me.lblNoLote.Caption = IIf(IsNull(Rst_DetalleDelProducto!Lote), "", Rst_DetalleDelProducto!Lote) & " " & IIf(IsNull(Rst_DetalleDelProducto!Estatus), "", Rst_DetalleDelProducto!Estatus)
                Me.lblFechaDeProducto.Caption = IIf(IsNull(Rst_DetalleDelProducto!Fecha), "", Rst_DetalleDelProducto!Fecha) & "  " & IIf(IsNull(Rst_DetalleDelProducto!TiempoAlmacen), "", Rst_DetalleDelProducto!TiempoAlmacen) & " días almacén"
                Me.lblProductoDisponible.Caption = IIf(IsNull(Rst_DetalleDelProducto!InventarioFinal), "", Rst_DetalleDelProducto!InventarioFinal) & " " & IIf(IsNull(Rst_DetalleDelProducto!Envasado), "", Rst_DetalleDelProducto!Envasado & " " & IIf(UCase(Rst_DetalleDelProducto!Envasado) = "TAMBOR", "(ES)", IIf(UCase(Rst_DetalleDelProducto!Envasado) = "CUBO", "(S)", "")))
                Me.lblKgMezcla.Caption = IIf(IsNull(Rst_DetalleDelProducto!KgMezcla), "0.00", Format(Rst_DetalleDelProducto!KgMezcla, "#,##0.00")) & " Kg."
                Me.lblConvertirUnidad.Caption = IIf(IsNull(Rst_DetalleDelProducto!ValorDeUnidad), "", Format(Rst_DetalleDelProducto!ValorDeUnidad, "#,##0.00")) & " " & IIf(IsNull(Rst_DetalleDelProducto!UnidadDeMedida), "", Rst_DetalleDelProducto!UnidadDeMedida)
            End If
        End If
    End With
End Sub


Private Sub CargaBody()
    Dim Rst_Busca As ADODB.Recordset
    Set Rst_Busca = New ADODB.Recordset
    
    Cr_Criterio = ""
    If Mid(Guarda_CveProducto, 1, 1) = "A" Then
        If Mid(Guarda_CveProducto, 2, 1) = "A" Then
            Cr_Criterio = Cr_Criterio & " Select * from Aceites_Modulo_AceitesLotes where IdAceiteLote = " & Val(Me.lblClaveInterna.Caption)
            With Rst_Busca
                If .State = 1 Then .Close
                .Open Cr_Criterio, Conexion, adOpenStatic, adLockReadOnly
                If Not (.EOF And .BOF) Then
                    lblOPP.Caption = IIf(IsNull(.Fields("OPP").Value), "", IIf(.Fields("OPP").Value = 0, "", .Fields("OPP").Value))
                    labelDIAZINON.ForeColor = &HC0C0C0: lblDIAZINON.BackColor = &HC0C0C0
                    labelIMAZALIL.ForeColor = &HC0C0C0: lblIMAZALIL.BackColor = &HC0C0C0
                    lblFENPROPATRIN.Caption = IIf(IsNull(.Fields("FENPROPATRIN").Value), "", IIf(.Fields("FENPROPATRIN").Value = 0, "", .Fields("FENPROPATRIN").Value))
                    lblCYFLUTRIN.Caption = IIf(IsNull(.Fields("CYFLUTRIN").Value), "", IIf(.Fields("CYFLUTRIN").Value = 0, "", .Fields("CYFLUTRIN").Value))
                    labelPYRIMETHANIL.ForeColor = &HC0C0C0: lblPYRIMETHANIL.BackColor = &HC0C0C0
                    lblTRIFLURALIN.Caption = IIf(IsNull(.Fields("TRIFLURALIN").Value), "", IIf(.Fields("TRIFLURALIN").Value = 0, "", .Fields("TRIFLURALIN").Value))
                    lblMALATION.Caption = IIf(IsNull(.Fields("MALATION").Value), "", IIf(.Fields("MALATION").Value = 0, "", .Fields("MALATION").Value))
                    lblETION.Caption = IIf(IsNull(.Fields("ETION").Value), "", IIf(.Fields("ETION").Value = 0, "", .Fields("ETION").Value))
                    lblFTHALATO.Caption = IIf(IsNull(.Fields("FTHALATO").Value), "", IIf(.Fields("FTHALATO").Value = 0, "", .Fields("FTHALATO").Value))
                    lblMETILPARATION.Caption = IIf(IsNull(.Fields("METILPARATION").Value), "", IIf(.Fields("METILPARATION").Value = 0, "", .Fields("METILPARATION").Value))
                    labelBROMACIL.ForeColor = &HC0C0C0: lblBROMACIL.BackColor = &HC0C0C0
                    lblDIMETOATO.Caption = IIf(IsNull(.Fields("DIMETOATO").Value), "", IIf(.Fields("DIMETOATO").Value = 0, "", .Fields("DIMETOATO").Value))
                    lblCLORPIRIFOS.Caption = IIf(IsNull(.Fields("CLORPIRIFOS").Value), "", IIf(.Fields("CLORPIRIFOS").Value = 0, "", .Fields("CLORPIRIFOS").Value))
                    lblPYBUTRIN.Caption = IIf(IsNull(.Fields("PYBUTRIN").Value), "", IIf(.Fields("PYBUTRIN").Value = 0, "", .Fields("PYBUTRIN").Value))
                    lblPERMETRINA.Caption = IIf(IsNull(.Fields("PERMETRINA").Value), "", IIf(.Fields("PERMETRINA").Value = 0, "", .Fields("PERMETRINA").Value))
                    labelSIMAZINE.ForeColor = &HC0C0C0: lblSIMAZINE.BackColor = &HC0C0C0
                    lblDICOFOL.Caption = IIf(IsNull(.Fields("DICOFOL").Value), "", IIf(.Fields("DICOFOL").Value = 0, "", .Fields("DICOFOL").Value))
                    lblBIFENTRINA.Caption = IIf(IsNull(.Fields("BIFENTRINA").Value), "", IIf(.Fields("BIFENTRINA").Value = 0, "", .Fields("BIFENTRINA").Value))
                    labelDIBUTIL.ForeColor = &HC0C0C0: lblDIBUTIL.BackColor = &HC0C0C0
                    lblObservaciones.Caption = IIf(IsNull(.Fields("Observaciones").Value), "", IIf(.Fields("Observaciones").Value = 0, "", .Fields("Observaciones").Value))
                Else
                
                End If
                If .State = 1 Then .Close
            End With
        End If
        
        If Mid(Guarda_CveProducto, 2, 1) = "B" Then
            Cr_Criterio = Cr_Criterio & " Select * from Aceites_Modulo_AromasLotes where IdAromaLote = " & Val(Me.lblClaveInterna.Caption)
            With Rst_Busca
                If .State = 1 Then .Close
                .Open Cr_Criterio, Conexion, adOpenStatic, adLockReadOnly
                If Not (.EOF And .BOF) Then
                    lblOPP.Caption = IIf(IsNull(.Fields("OPP").Value), "", IIf(.Fields("OPP").Value = 0, "", .Fields("OPP").Value))
                    lblDIAZINON.Caption = IIf(IsNull(.Fields("DIAZINON").Value), "", IIf(.Fields("DIAZINON").Value = 0, "", .Fields("DIAZINON").Value))
                    lblIMAZALIL.Caption = IIf(IsNull(.Fields("IMAZALIL").Value), "", IIf(.Fields("IMAZALIL").Value = 0, "", .Fields("IMAZALIL").Value))
                    lblFENPROPATRIN.Caption = IIf(IsNull(.Fields("Fenpropatri").Value), "", IIf(.Fields("Fenpropatri").Value = 0, "", .Fields("Fenpropatri").Value))
                    lblCYFLUTRIN.Caption = IIf(IsNull(.Fields("CYFLUTRIN").Value), "", IIf(.Fields("CYFLUTRIN").Value = 0, "", .Fields("CYFLUTRIN").Value))
                    lblPYRIMETHANIL.Caption = IIf(IsNull(.Fields("PYRIMETHANIL").Value), "", IIf(.Fields("PYRIMETHANIL").Value = 0, "", .Fields("PYRIMETHANIL").Value))
                    lblTRIFLURALIN.Caption = IIf(IsNull(.Fields("TRIFLURALIN").Value), "", IIf(.Fields("TRIFLURALIN").Value = 0, "", .Fields("TRIFLURALIN").Value))
                    lblMALATION.Caption = IIf(IsNull(.Fields("MALATION").Value), "", IIf(.Fields("MALATION").Value = 0, "", .Fields("MALATION").Value))
                    lblETION.Caption = IIf(IsNull(.Fields("ETION").Value), "", IIf(.Fields("ETION").Value = 0, "", .Fields("ETION").Value))
                    lblFTHALATO.Caption = IIf(IsNull(.Fields("FTHALATO").Value), "", IIf(.Fields("FTHALATO").Value = 0, "", .Fields("FTHALATO").Value))
                    lblMETILPARATION.Caption = IIf(IsNull(.Fields("METILPARATION").Value), "", IIf(.Fields("METILPARATION").Value = 0, "", .Fields("METILPARATION").Value))
                    lblBROMACIL.Caption = IIf(IsNull(.Fields("BROMACIL").Value), "", IIf(.Fields("BROMACIL").Value = 0, "", .Fields("BROMACIL").Value))
                    lblDIMETOATO.Caption = IIf(IsNull(.Fields("DIMETOATO").Value), "", IIf(.Fields("DIMETOATO").Value = 0, "", .Fields("DIMETOATO").Value))
                    lblCLORPIRIFOS.Caption = IIf(IsNull(.Fields("CLORPIRIFOS").Value), "", IIf(.Fields("CLORPIRIFOS").Value = 0, "", .Fields("CLORPIRIFOS").Value))
                    lblPYBUTRIN.Caption = IIf(IsNull(.Fields("PYBUTRIN").Value), "", IIf(.Fields("PYBUTRIN").Value = 0, "", .Fields("PYBUTRIN").Value))
                    lblPERMETRINA.Caption = IIf(IsNull(.Fields("PERMETRINA").Value), "", IIf(.Fields("PERMETRINA").Value = 0, "", .Fields("PERMETRINA").Value))
                    lblSIMAZINE.Caption = IIf(IsNull(.Fields("SIMAZINE").Value), "", IIf(.Fields("SIMAZINE").Value = 0, "", .Fields("SIMAZINE").Value))
                    labelDICOFOL.ForeColor = &HC0C0C0: lblDICOFOL.BackColor = &HC0C0C0
                    labelBIFENTRINA.ForeColor = &HC0C0C0: lblBIFENTRINA.BackColor = &HC0C0C0
                    labelDIBUTIL.ForeColor = &HC0C0C0: lblDIBUTIL.BackColor = &HC0C0C0
                    lblObservaciones.Caption = IIf(IsNull(.Fields("Observaciones").Value), "", IIf(.Fields("Observaciones").Value = 0, "", .Fields("Observaciones").Value))
                Else
                
                End If
                If .State = 1 Then .Close
            End With
        End If
    
        If Mid(Guarda_CveProducto, 2, 1) = "C" Then
            Cr_Criterio = Cr_Criterio & " Select * from Aceites_Modulo_EsenciaLotes where IdEsenciaLote = " & Val(Me.lblClaveInterna.Caption)
            With Rst_Busca
                If .State = 1 Then .Close
                .Open Cr_Criterio, Conexion, adOpenStatic, adLockReadOnly
                If Not (.EOF And .BOF) Then
                    lblOPP.Caption = IIf(IsNull(.Fields("OPP").Value), "", IIf(.Fields("OPP").Value = 0, "", .Fields("OPP").Value))
                    lblDIAZINON.Caption = IIf(IsNull(.Fields("DIAZINON").Value), "", IIf(.Fields("DIAZINON").Value = 0, "", .Fields("DIAZINON").Value))
                    lblIMAZALIL.Caption = IIf(IsNull(.Fields("IMAZALIL").Value), "", IIf(.Fields("IMAZALIL").Value = 0, "", .Fields("IMAZALIL").Value))
                    lblFENPROPATRIN.Caption = IIf(IsNull(.Fields("Fenpropatri").Value), "", IIf(.Fields("Fenpropatri").Value = 0, "", .Fields("Fenpropatri").Value))
                    lblCYFLUTRIN.Caption = IIf(IsNull(.Fields("CYFLUTRIN").Value), "", IIf(.Fields("CYFLUTRIN").Value = 0, "", .Fields("CYFLUTRIN").Value))
                    lblPYRIMETHANIL.Caption = IIf(IsNull(.Fields("PYRIMETHANIL").Value), "", IIf(.Fields("PYRIMETHANIL").Value = 0, "", .Fields("PYRIMETHANIL").Value))
                    lblTRIFLURALIN.Caption = IIf(IsNull(.Fields("TRIFLURALIN").Value), "", IIf(.Fields("TRIFLURALIN").Value = 0, "", .Fields("TRIFLURALIN").Value))
                    lblMALATION.Caption = IIf(IsNull(.Fields("MALATION").Value), "", IIf(.Fields("MALATION").Value = 0, "", .Fields("MALATION").Value))
                    lblETION.Caption = IIf(IsNull(.Fields("ETION").Value), "", IIf(.Fields("ETION").Value = 0, "", .Fields("ETION").Value))
                    lblFTHALATO.Caption = IIf(IsNull(.Fields("FTHALATO").Value), "", IIf(.Fields("FTHALATO").Value = 0, "", .Fields("FTHALATO").Value))
                    lblMETILPARATION.Caption = IIf(IsNull(.Fields("METILPARATION").Value), "", IIf(.Fields("METILPARATION").Value = 0, "", .Fields("METILPARATION").Value))
                    lblBROMACIL.Caption = IIf(IsNull(.Fields("BROMACIL").Value), "", IIf(.Fields("BROMACIL").Value = 0, "", .Fields("BROMACIL").Value))
                    lblDIMETOATO.Caption = IIf(IsNull(.Fields("DIMETOATO").Value), "", IIf(.Fields("DIMETOATO").Value = 0, "", .Fields("DIMETOATO").Value))
                    lblCLORPIRIFOS.Caption = IIf(IsNull(.Fields("CLORPIRIFOS").Value), "", IIf(.Fields("CLORPIRIFOS").Value = 0, "", .Fields("CLORPIRIFOS").Value))
                    lblPYBUTRIN.Caption = IIf(IsNull(.Fields("PYBUTRIN").Value), "", IIf(.Fields("PYBUTRIN").Value = 0, "", .Fields("PYBUTRIN").Value))
                    lblPERMETRINA.Caption = IIf(IsNull(.Fields("PERMETRINA").Value), "", IIf(.Fields("PERMETRINA").Value = 0, "", .Fields("PERMETRINA").Value))
                    lblSIMAZINE.Caption = IIf(IsNull(.Fields("SIMAZINE").Value), "", IIf(.Fields("SIMAZINE").Value = 0, "", .Fields("SIMAZINE").Value))
                    labelDICOFOL.ForeColor = &HC0C0C0: lblDICOFOL.BackColor = &HC0C0C0
                    labelBIFENTRINA.ForeColor = &HC0C0C0: lblBIFENTRINA.BackColor = &HC0C0C0
                    labelDIBUTIL.ForeColor = &HC0C0C0: lblDIBUTIL.BackColor = &HC0C0C0
                    lblObservaciones.Caption = IIf(IsNull(.Fields("Observaciones").Value), "", IIf(.Fields("Observaciones").Value = 0, "", .Fields("Observaciones").Value))
                Else
                
                End If
                If .State = 1 Then .Close
            End With
        End If
    
        If Mid(Guarda_CveProducto, 2, 1) = "D" Then
            Cr_Criterio = Cr_Criterio & " Select * from Aceites_Modulo_EsenciaLotes where IdEsenciaLote = " & Val(Me.lblClaveInterna.Caption)
            With Rst_Busca
                If .State = 1 Then .Close
                .Open Cr_Criterio, Conexion, adOpenStatic, adLockReadOnly
                If Not (.EOF And .BOF) Then
                    lblOPP.Caption = IIf(IsNull(.Fields("OPP").Value), "", IIf(.Fields("OPP").Value = 0, "", .Fields("OPP").Value))
                    lblDIAZINON.Caption = IIf(IsNull(.Fields("DIAZINON").Value), "", IIf(.Fields("DIAZINON").Value = 0, "", .Fields("DIAZINON").Value))
                    lblIMAZALIL.Caption = IIf(IsNull(.Fields("IMAZALIL").Value), "", IIf(.Fields("IMAZALIL").Value = 0, "", .Fields("IMAZALIL").Value))
                    lblFENPROPATRIN.Caption = IIf(IsNull(.Fields("Fenpropatri").Value), "", IIf(.Fields("Fenpropatri").Value = 0, "", .Fields("Fenpropatri").Value))
                    lblCYFLUTRIN.Caption = IIf(IsNull(.Fields("CYFLUTRIN").Value), "", IIf(.Fields("CYFLUTRIN").Value = 0, "", .Fields("CYFLUTRIN").Value))
                    lblPYRIMETHANIL.Caption = IIf(IsNull(.Fields("PYRIMETHANIL").Value), "", IIf(.Fields("PYRIMETHANIL").Value = 0, "", .Fields("PYRIMETHANIL").Value))
                    lblTRIFLURALIN.Caption = IIf(IsNull(.Fields("TRIFLURALIN").Value), "", IIf(.Fields("TRIFLURALIN").Value = 0, "", .Fields("TRIFLURALIN").Value))
                    lblMALATION.Caption = IIf(IsNull(.Fields("MALATION").Value), "", IIf(.Fields("MALATION").Value = 0, "", .Fields("MALATION").Value))
                    lblETION.Caption = IIf(IsNull(.Fields("ETION").Value), "", IIf(.Fields("ETION").Value = 0, "", .Fields("ETION").Value))
                    lblFTHALATO.Caption = IIf(IsNull(.Fields("FTHALATO").Value), "", IIf(.Fields("FTHALATO").Value = 0, "", .Fields("FTHALATO").Value))
                    lblMETILPARATION.Caption = IIf(IsNull(.Fields("METILPARATION").Value), "", IIf(.Fields("METILPARATION").Value = 0, "", .Fields("METILPARATION").Value))
                    labelBROMACIL.ForeColor = &HC0C0C0: lblBROMACIL.BackColor = &HC0C0C0
                    lblDIMETOATO.Caption = IIf(IsNull(.Fields("DIMETOATO").Value), "", IIf(.Fields("DIMETOATO").Value = 0, "", .Fields("DIMETOATO").Value))
                    lblCLORPIRIFOS.Caption = IIf(IsNull(.Fields("CLORPIRIFOS").Value), "", IIf(.Fields("CLORPIRIFOS").Value = 0, "", .Fields("CLORPIRIFOS").Value))
                    lblPYBUTRIN.Caption = IIf(IsNull(.Fields("PYBUTRIN").Value), "", IIf(.Fields("PYBUTRIN").Value = 0, "", .Fields("PYBUTRIN").Value))
                    lblPERMETRINA.Caption = IIf(IsNull(.Fields("PERMETRINA").Value), "", IIf(.Fields("PERMETRINA").Value = 0, "", .Fields("PERMETRINA").Value))
                    lblSIMAZINE.Caption = IIf(IsNull(.Fields("SIMAZINE").Value), "", IIf(.Fields("SIMAZINE").Value = 0, "", .Fields("SIMAZINE").Value))
                    labelDICOFOL.ForeColor = &HC0C0C0: lblDICOFOL.BackColor = &HC0C0C0
                    labelBIFENTRINA.ForeColor = &HC0C0C0: lblBIFENTRINA.BackColor = &HC0C0C0
                    labelDIBUTIL.ForeColor = &HC0C0C0: lblDIBUTIL.BackColor = &HC0C0C0
                    lblObservaciones.Caption = IIf(IsNull(.Fields("Observaciones").Value), "", IIf(.Fields("Observaciones").Value = 0, "", .Fields("Observaciones").Value))
                Else
                
                End If
                If .State = 1 Then .Close
            End With
        End If
    End If
End Sub
