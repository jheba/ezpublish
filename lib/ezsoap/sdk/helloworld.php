<?php
//
// Created on: <28-May-2002 11:21:41 bf>
//
// Copyright (C) 1999-2002 eZ systems as. All rights reserved.
//
// This source file is part of the eZ publish (tm) Open Source Content
// Management System.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 as published by the Free
// Software Foundation and appearing in the file LICENSE.GPL included in
// the packaging of this file.
//
// Licencees holding valid "eZ publish professional licences" may use this
// file in accordance with the "eZ publish professional licence" Agreement
// provided with the Software.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "eZ publish professional licence" is available at
// http://ez.no/home/licences/professional/. For pricing of this licence
// please contact us via e-mail to licence@ez.no. Further contact
// information is available at http://ez.no/home/contact/.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@ez.no if any conditions of this licencing isn't clear to
// you.
//

?>
<p>
Every SDK with programming examples must contain a hello world example, eZ soap&trade; is no
exception. This example shows how you can send a request to a SOAP server and print out the
result.
</p>

<h1>Talking with the server</h1>
<p>
The default transport in eZ soap&trade; is HTTP. In this example we set up a client
object to talk to the server myserver.com and the path /helloworld.
</p>
<pre class="example">
include_once( "lib/ezsoap/classes/ezsoapclient.php" );
include_once( "lib/ezsoap/classes/ezsoaprequest.php" );

$client = new eZSOAPClient( "myserver.com", "/helloworld" );
</pre>

<h1>Sending a request</h1>
<p>
You need to prepare a request object which you're going to send. In this example
we have a simple request without any parameters. All we need to do is to give the
request name, <b>helloWorld</b>, and the target namespace, <b>http://sdk.ez.no/soap/examples</b>.
This object is then sent to the server via the client.
</p>

<pre class="example">
$request = new eZSOAPRequest( "helloWorld", "http://sdk.ez.no/soap/examples" );

$response =& $client->send( $request );
</pre>

<h1>Response</h1>
<p>
When the request is sent you will get a response returned from the server. This response
will be returned by eZ soap&trade; as a eZSOAPResponse object. If the server returned a fault
the faultcode and faultstring is printed. If all was successful the response value from the server
is printed.
</p>

<p>
As you can see the values returned from the server is automatically converted to PHP types all the
encoding/decoding of data is handled by the eZ soap&trade; library.
</p>

<pre class="example">

if ( $response->isFault() )
{
    print( "SOAP fault: " . $response->faultCode(). " - " . $response->faultString() . "" );
}
else
    print( "Returned SOAP value was: \"" . $response->value() . "\"" );
</pre>

<h1>The server</h1>
<p>
To create a SOAP server is just as simple as the client. All you need to do is to create a eZSOAPServer
object. Then you need to register the functions which should be available. These functions is normal
PHP functions returning normal PHP variables, eZ soap&trade; handles the rest. To process the incomming
request you run the function <b>processRequest()</b>.
</p>

<pre class="example">
include_once( "lib/ezsoap/classes/ezsoapserver.php" );

$server = new eZSOAPServer();

$server->registerFunction( "helloWorld" );

$server->processRequest();

function helloWorld()
{
    return "Hello World!";
}
</pre>

<h1>The running example</h1>
<p>
Below you will see this hello world example in action.
</p>
<?php

include_once( "lib/ezsoap/classes/ezsoapclient.php" );
include_once( "lib/ezsoap/classes/ezsoaprequest.php" );


$client = new eZSOAPClient( eZSys::hostname(), eZSys::wwwDir() .  eZSys::indexFile() . "/sdk/ezsoap/view/helloworldserver" );
$request = new eZSOAPRequest( "helloWorld", "http://sdk.ez.no/soap/examples" );

$response =& $client->send( $request );

if ( $response->isFault() )
{
    print( "SOAP fault: " . $response->faultCode(). " - " . $response->faultString() . "" );
}
else
    print( "Returned SOAP value was: \"" . $response->value() . "\"" );


?>
