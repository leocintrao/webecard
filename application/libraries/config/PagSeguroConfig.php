<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

//$PagSeguroConfig['environment'] = array();
$PagSeguroConfig['environment'] = "production"; // production, sandbox

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "info@webecard.net";
$PagSeguroConfig['credentials']['token']['production'] = "A5A0C5F59A584911915F7235828CB57D";
$PagSeguroConfig['credentials']['token']['sandbox'] = "your_sandbox_pagseguro_token";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = TRUE;
$PagSeguroConfig['log']['fileLocation'] = "ps/log.txt";
