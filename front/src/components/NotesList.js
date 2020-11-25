import React, {useEffect, useState} from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Button from "react-bootstrap/Button";
import {Link} from "react-router-dom";

function chunk(arr, len) {
  var chunks = [],
    i = 0,
    n = arr.length;

  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }

  return chunks;
}



const NotesList = () => {
  const [notes, setNotes] = useState([]);

  const deleteNote = (id) => {
    fetch(`http://192.1.9.2/notes/${id}`, {method: 'DELETE'})
    setNotes(notes.filter(value => value.id !== id))
  }

  useEffect(() => {
    fetch("http://192.1.9.2/notes")
      .then(response => response.json())
      .then(response => {
        setNotes(response.data)
      })
  }, [])

  return (
    <div>
      {
        notes.map((item) => {
          return (
            <Card>
              <Card.Body>
                <Card.Title>{item.title}</Card.Title>
                <Card.Text>
                  Created at {item.createdAt}
                </Card.Text>
                <Link to={`/notes/${item.id}`}>
                  <Button variant="primary">Edit</Button>
                </Link>


                <Button variant="danger" onClick={()=>{deleteNote(item.id)}}>Delete</Button>
              </Card.Body>
            </Card>
          )
        })
      }
    </div>
  )
}

export default NotesList;
