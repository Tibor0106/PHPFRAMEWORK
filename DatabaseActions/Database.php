<?php
class DatabaseAction
{
    public function __construct()
    {
    }

    public function Update($sql): Response
    {
        return $this->UpdateAndDeleteAndInsertExecute($sql);
    }

    public function Insert($sql): Response
    {
        return $this->UpdateAndDeleteAndInsertExecute($sql);
    }

    public function Delete($sql): Response
    {
        return $this->UpdateAndDeleteAndInsertExecute($sql);
    }

    public function Select($sql): Response
    {     
        return $this->SelectExecute($sql);
    }

    private function UpdateAndDeleteAndInsertExecute(string $sql): Response {
        require_once "../ConnectionData.php";
        if ($conn->query($sql) === TRUE)  return new Response(True,200);
        return new Response(False,500);        
    }
    private function SelectExecute(string $sql): Response
    {
        require_once "../ConnectionData.php";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return new Response("Error preparing statemenet",500);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return new Response(json_encode($data), 200);
    }  
}
