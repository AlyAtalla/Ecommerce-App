import React from 'react';
import axios from 'axios';

const PostRequestButton = () => {
  const handleClick = async () => {
    try {
      const response = await axios.post('http://localhost:3000/your-endpoint', {
        param1: 'value1',
        param2: 'value2'
      });
      console.log(response.data);
    } catch (error) {
      console.error('Error:', error);
    }
  };

  return (
    <button onClick={handleClick}>Send POST Request</button>
  );
};

export default PostRequestButton;