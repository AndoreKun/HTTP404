-- Se retornar erro em algum comando, insira cada permissão individualmente!

-- Criar usuário e dar privilégios para `patrao`@`localhost`

CREATE USER `patrao`@`localhost` IDENTIFIED BY 'patrao&%2021';

GRANT SELECT ON `adc_http404`.`vendas` TO `patrao`@`localhost`;


-- Criar usuário e dar privilégios para `vendedores`@`localhost`

CREATE USER 'vendedores'@'localhost' IDENTIFIED BY 'vendedores$2021*';

GRANT SELECT, INSERT, UPDATE, DELETE ON `adc_http404`.`clientes` TO `vendedores`@`localhost`; 

GRANT SELECT, INSERT, UPDATE, DELETE ON `adc_http404`.`veiculos` TO `vendedores`@`localhost`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `adc_http404`.`artigos` TO `vendedores`@`localhost`;
 
GRANT SELECT, INSERT ON `adc_http404`.`vendas` TO `vendedores`@`localhost`;


-- Criar usuário e dar privilégios para `admin`@`localhost`

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'http404#2021%';

GRANT ALL PRIVILEGES ON `adc_http404`.* TO `admin`@`localhost`;


FLUSH PRIVILEGES;



