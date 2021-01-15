window.dd = function() {
  for (i = 0; i < arguments.length; i++) {
    console.log(arguments[i])
  }
}

window.unaccent = function(inStr) {
  if (typeof inStr == 'string') {
    return inStr.replace(
      /([àáâãäå])|([ç])|([èéêë])|([ìíîï])|([ñ])|([òóôõöø])|([ß])|([ùúûü])|([ÿ])|([æ])/g,
      function(str, a, c, e, i, n, o, s, u, y, ae) {
        if (a) return 'a'
        else if (c) return 'c'
        else if (e) return 'e'
        else if (i) return 'i'
        else if (n) return 'n'
        else if (o) return 'o'
        else if (s) return 's'
        else if (u) return 'u'
        else if (y) return 'y'
        else if (ae) return 'ae'
      },
    )
  }

  return ''
}

window.basename = str => {
  let base = new String(str).substring(str.lastIndexOf('/') + 1)

  if (base.lastIndexOf('.') != -1) {
    base = base.substring(0, base.lastIndexOf('.'))
  }

  return base
}

window.uuid = function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1)
  }

  return (
    s4() +
    s4() +
    '-' +
    s4() +
    '-' +
    s4() +
    '-' +
    s4() +
    '-' +
    s4() +
    s4() +
    s4()
  )
}

window.clone = obj => {
  return JSON.parse(JSON.stringify(obj))
}

// --------------------------- empty()
// dd(empty(false))
// dd(empty(''))
// dd(empty(' '))
// dd(empty(null))
// dd(empty(thisVariableDoesNotExists.a))
// dd(empty(thisVariableDoesNotExists.b))
// dd(empty([]))
// dd(empty({}))
// dd(empty(thisVariableDoesNotExists))

window.empty = function(variable) {
  if (
    variable === false ||
    variable === null ||
    variable === '' ||
    typeof variable === 'undefined' ||
    (typeof variable === 'string' && variable.trim().length === 0) ||
    (variable instanceof Array && variable.length === 0) ||
    (typeof variable === 'object' &&
      Object.keys(variable).length === 0 &&
      variable.constructor === Object)
  ) {
    return true
  }

  return false
}

window.findItemByValue = (item, list, field) => {
  field = !field ? 'id' : field

  if (empty(list) || item === null) {
    return null
  }

  if (typeof list === 'object') {
    for (let key in list) {
      if (list[key][field] === item) {
        return list[key]
      }
    }
  }

  if (typeof list === 'array') {
    for (let i = 0; i < list.length; i++) {
      if (list[i][field] === item) {
        return list[i]
      }
    }
  }

  return null
}
