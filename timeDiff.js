function timeDiff(timeDifferenceInMilliseconds){


    let timeDifferenceText;
    if (timeDifferenceInMilliseconds<60000) {
        timeDifferenceText = ` Few seconds ago`;
        return timeDifferenceText;
    }
    if (timeDifferenceInMilliseconds >= 86400000) {  
      const daysDifference = Math.floor(timeDifferenceInMilliseconds / 86400000);
      timeDifferenceText = `${daysDifference} day${daysDifference !== 1 ? 's' : ''} ago`;
    } else if (timeDifferenceInMilliseconds >= 3600000) {  
      const hoursDifference = Math.floor(timeDifferenceInMilliseconds / 3600000);
      timeDifferenceText = `${hoursDifference} hour${hoursDifference !== 1 ? 's' : ''} ago`;
    } else {
      const minutesDifference = Math.floor(timeDifferenceInMilliseconds / 60000);
      timeDifferenceText = `${minutesDifference} minute${minutesDifference !== 1 ? 's' : ''} ago`;
    }
      return timeDifferenceText;
    }