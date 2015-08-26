<?php
header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<definitions xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" 
	     xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"
             xmlns:s="http://www.w3.org/2001/XMLSchema" 
             xmlns:tns="http://soapinterop.org/"
	     xmlns:types="http://soapinterop.org/xsd" 
             targetNamespace="http://soapinterop.org/" 
	     xmlns="http://schemas.xmlsoap.org/wsdl/">
  <types>
    <s:schema elementFormDefault="qualified" targetNamespace="http://soapinterop.org/xsd">
      <s:element name="echoStringParam" type="s:string"/>
         
      <s:element name="echoStringReturn" type="s:string"/>

      <s:element name="Header1" type="types:Header1" />
      <s:complexType name="Header1">
        <s:sequence>
          <s:element name="string" type="s:string" />
          <s:element name="int" type="s:int" />
        </s:sequence>
	<s:anyAttribute />
      </s:complexType>
      <s:element name="Header2" type="types:Header2" />
      <s:complexType name="Header2">
        <s:sequence>
          <s:element name="int" type="s:int" />
          <s:element name="string" type="s:string" />
        </s:sequence>
	<s:anyAttribute />
      </s:complexType>
    </s:schema>
  </types>
  <message name="echoString">
        <part element="types:echoStringParam" name="a"/>
    </message>
    <message name="echoStringResponse">
        <part element="types:echoStringReturn" name="result"/>
    </message>
  <message name="Header1">
    <part name="Header1" element="types:Header1" />
  </message>
  <message name="Header2">
    <part name="Header2" element="types:Header2" />
  </message>
  <portType name="RetHeaderPortType">
    <operation name="echoString">
      <input message="tns:echoString" />
      <output message="tns:echoStringResponse" />
    </operation>
  </portType>
  <binding name = "RetHeaderBinding" type="tns:RetHeaderPortType">
    <soap:binding transport="http://schemas.xmlsoap.org/soap/http" style="document" />
    <operation name="echoString">
      <soap:operation soapAction="http://soapinterop.org/" style="document" />
      <input>
        <soap:body use="literal" />
        <soap:header message="tns:Header1" part="Header1" use="literal"/>
        <soap:header message="tns:Header2" part="Header2" use="literal"/>
      </input>
      <output>
        <soap:body use="literal" />
      </output>
    </operation>
  </binding>
  <service name="RetHeaderService">
    <port name="RetHeaderPort" binding="tns:RetHeaderBinding">
        <soap:address location="http://<?php echo $_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];?>/soap_interop/server_round3.php"/>
    </port>
  </service>
</definitions>