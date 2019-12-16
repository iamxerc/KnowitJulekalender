# Seilkryss

Av: Didrik Pemmer Aalen

Birte befinner seg på en seilbåt helt innerst i den lange julefjorden. Hun har et ønske om å komme seg ut, slik at hun kommer seg hjem til jul, men vindforholdene gjør det vanskelig. For å komme seg ut av fjorden må hun følge disse reglene:

1. Hun kan kun krysse nordøst (x+1, y+1) og sørøst (x+1, y-1).
2. Hun **må** snu når hun er 20 meter fra land (i retning nord/sør).

## Oppgave
Gitt [følgende fjord](https://julekalender.knowit.no/resources/2019-luke16/fjord.txt), hvor mange ganger ender Birte opp med å krysse for å komme seg ut av fjorden når hun begynner å krysse mot nordøst?

OBS! Antall kryssinger er definert som antall strekninger hun seiler, ikke antall ganger hun snur. 

## Eksempel

Her er følgende definert:

```
B = Birte
# = Land
Tomme ruter er vann
/ og \ viser ruten til Birte i svaret
```

Hver rute er 10 meter lang.

Gitt følgende fjord:

```
####################
#    ###
#            
#
#
#
#
#
#B
###    ####     #   
####################
```

Blir kryssingene slik:

```
####################
#    ###
#            
#           /\      
#    /\    /  \    /
#   /  \  /    \  /
#  /    \/      \/
# /              
#B
###    ####     #   
####################
```

Og Birte ender med 5 kryssinger.