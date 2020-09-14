import React from 'react';
import Button from '@material-ui/core/Button';
import Snackbar from '@material-ui/core/Snackbar';

export default function Alert() {
  const [state, setState] = React.useState(false);

  const { vertical, horizontal, open } = state;

  const handleClick = () => {
    setState(true);
  };

  function handleClose() {
    setState(false);
  }

  return (
    <div>
      <Button onClick={handleClick}></Button>
      <Snackbar
        anchorOrigin={{ vertical, horizontal }}
        key={'top,center'}
        open={open}
        onClose={handleClose}
        ContentProps={{
          'aria-describedby': 'message-id',
        }}
        message={<span id="message-id">I love snacks</span>}
      />
    </div>
  );
}