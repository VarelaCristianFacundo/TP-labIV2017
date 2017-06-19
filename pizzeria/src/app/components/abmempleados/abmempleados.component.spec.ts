import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AbmempleadosComponent } from './abmempleados.component';

describe('AbmempleadosComponent', () => {
  let component: AbmempleadosComponent;
  let fixture: ComponentFixture<AbmempleadosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AbmempleadosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AbmempleadosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
