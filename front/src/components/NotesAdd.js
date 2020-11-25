import React, {useEffect, useState} from "react";
import Card from "react-bootstrap/Card";
import Button from "react-bootstrap/Button";
import {Link, useParams} from "react-router-dom";

function chunk(arr, len) {
  var chunks = [],
    i = 0,
    n = arr.length;

  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }

  return chunks;
}

const NotesAdd = () => {
  const [title, setTitle] = useState(null);
  const [content, setContent] = useState(null);

  const submit = () => {
    fetch(
      `http://192.1.9.2/notes`,
      {
        method: 'POST',
        body: JSON.stringify({
          title: title,
          content: content
        }),
        headers: {
          'Content-Type': 'application/json'
        }
      }
    )
  }

  return (
    <div>
      <Card>
        <Card.Body>
          <Card.Title>
            <input type="text" onChange={(event => setTitle(event.target.value))} value={title}/>
          </Card.Title>
          <Card.Text>
            <textarea name="" id="" cols="60" rows="20" onChange={(event => setContent(event.target.value))} value={content}/>
          </Card.Text>

          <Button variant="primary" onClick={()=>{submit()}}>Save</Button>
        </Card.Body>
      </Card>
    </div>
  )
}

export default NotesAdd;
