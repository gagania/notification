<?php
class Notification_test extends TestCase
{

	var $xml_user1 = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<xml><id>1</id><name>John</name><email>john@example.com</email><fact>Loves coding</fact></xml>\n";

	/**
	 * @group patcher
	 */
	public function test_index_get()
	{
		$output = $this->request('GET', 'api/notification/index');
		$expected = '[{"id":1,"name":"John","email":"john@example.com","fact":"Loves coding"},{"id":2,"name":"Jim","email":"jim@example.com","fact":"Developed on CodeIgniter"},{"id":3,"name":"Jane","email":"jane@example.com","fact":"Lives in the USA","0":{"hobbies":["guitar","cycling"]}}]';
		$this->assertEquals($expected, $output);
		$this->assertResponseCode(200);
	}
}

