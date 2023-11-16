// column is the header you clicked on
// so clicking on age will only sort by age ect...
function sortTable(column) {
    var table = document.getElementsByTagName("table")[0];
    // Skip header row
    var rows = Array.from(table.rows).slice(1); 
    // sort content
    var sortedRows = mergeSort(rows, column);

    // Update the table with the sorted rows
    for (var i = 0; i < sortedRows.length; i++) {
        table.tBodies[0].appendChild(sortedRows[i]);
    }
}

function mergeSort(arr, column) {
    // if the array is empty or down to a sigle value then return
    if (arr.length <= 1) {
        return arr;
    }

    // variables for the middle left and right for the sort
    var middle = Math.floor(arr.length / 2);
    var left = arr.slice(0, middle);
    var right = arr.slice(middle);

    // repeat the process for each side
    // this will repeat until single values are reached
    left = mergeSort(left, column);
    right = mergeSort(right, column);

    // by the end of this proccess the table will be split into a tree of single values
    return merge(left, right, column);
}

function merge(left, right, column) {
    // set up null variables
    var result = [];
    var i = 0, j = 0;

    // this iteration is how the sort moves through the data
    while (i < left.length && j < right.length) {
        // these are the two values to be compared
        var x = left[i].getElementsByTagName("td")[column];
        var y = right[j].getElementsByTagName("td")[column];

        var isNumeric = !isNaN(x.innerHTML) && !isNaN(y.innerHTML);

        // this is set up to work for numbers or strings soit is an or statement with both
        if ((isNumeric && Number(x.innerHTML) < Number(y.innerHTML)) ||
            (!isNumeric && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {
        // this if else sorts the two values 
            result.push(left[i]);
            i++;
        } else {
            result.push(right[j]);
            j++;
        }
    }

    // concatinate the two values to be returned
    return result.concat(left.slice(i)).concat(right.slice(j));
}
