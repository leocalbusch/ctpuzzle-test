function printAtWordWrap(context, text, x, y, lineHeight) {

  let count = 1;
  text.split('\n').forEach(function (text) {
    context.fillText(text, x, y + lineHeight * count)
    count++;
  })
}
