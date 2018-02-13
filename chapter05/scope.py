def inc1(var):
    var += 1
    return var


var = 1
print('before var = %s' % var) 
inc1(var)
print('after var =', var)

